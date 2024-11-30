<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Helpers\Toast;
use App\Models\Admin;
use App\Models\AdminActivity;
use Exception;
use PDO;

class AdminAuthController extends Controller
{
	private $Admin;
	private $Activity;

	public function __construct()
	{
		$this->Admin = new Admin();
		$this->Activity = new AdminActivity();
		parent::__construct();
	}

	public function store()
	{
		$this->CSRFToken->check();
		$this->Auth::checkUserIsLoggedInOrRedirect('adminId', '/admin');

		try {
			$validators  = [
				'name' => ['required' => true, 'maxLength' => 50, 'unique' => ['admins', 'name', PDO::PARAM_STR]],
				'level' => ['required' => true, 'num' => true],
				'email' => ['required' => true, 'maxLength' => 150, 'email' => true, 'unique' => ['admins', 'email', PDO::PARAM_STR]],
				'password' => ['required' => true, 'password' => true, 'minLength' => 5, 'maxLength' => 500],
			];

			$errors = $this->Validator->validate($validators);


			if (!empty($errors)) {
				if (isset($_POST['csrf'])) unset($_POST['csrf']);
				$_SESSION['add_admin_prev'] = $_POST;
				$_SESSION['add_admin_errors'] = $errors;
				Toast::set('Az űrlap hibásan lett kitöltve, vagy már létezik ilyen névvel vagy e-mail címmel admin.', 'danger', '/admin/settings', null);
				exit;
			}


			$is_success = $this->Admin->storeAdmin($_POST);

			if (!$is_success) {
				return Toast::set('Admin hozzáadása sikertelen, kérjük próbálja meg más adatokkal!', 'danger', '/admin/settings', null);
			}

			$this->Activity->store([
				'content' => "Új admint adott hozzá: " . $_POST['name'] . ", level(" . $_POST['level'] . ")",
				'contentInEn' => null,
				'adminRefId' => $_SESSION['adminId']
			], $_SESSION['adminId']);

			if (isset($_SESSION['add_admin_prev'])) unset($_SESSION['add_admin_prev']);
			if (isset($_SESSION['add_admin_errors'])) unset($_SESSION['add_admin_errors']);

			return Toast::set('Admin sikeresen hozzáadva', 'success', '/admin/settings', null);
		} catch (Exception $e) {
			error_log($e->getMessage());
			Toast::set('Hiba történt az admin hozzáadásakor. Általános szerver hiba...', 'danger', '/admin/settings', null);
		}
	}


	public function logout()
	{
		try {
			$this->CSRFToken->check();
			session_start();
			session_destroy();
			session_regenerate_id(true);

			$cookieParams = session_get_cookie_params();
			setcookie(session_name(), "", 0, $cookieParams["path"], $cookieParams["domain"], $cookieParams["secure"], isset($cookieParams["httponly"]));

			header("Location: /admin");
			exit();
		} catch (Exception $e) {
			http_response_code(500);
			echo "Internal Server Error" . $e->getMessage();
			return;
		}
	}

	public function login()
	{
		session_start();
		$this->CSRFToken->check();
		$name = isset($_POST["name"]) ? filter_var($_POST["name"] ?? '', FILTER_SANITIZE_SPECIAL_CHARS) : null;
		$pw = isset($_POST["password"]) ? filter_var($_POST["password"] ?? '', FILTER_SANITIZE_SPECIAL_CHARS) : null;

		try {
			$validators  = [
				'name' => ['required' => true, 'maxLength' => 50],
				'password' => ['required' => true, 'password' => true, 'minLength' => 5],
			];

			$errors = $this->Validator->validate($validators);

			if (!empty($errors)) {
				if (isset($_POST['csrf'])) unset($_POST['csrf']);
				$_SESSION['login_admin_prev'] = $_POST;
				$_SESSION['login_admin_errors'] = $errors;
				return Toast::set('Az űrlap hibásan lett kitöltve, vagy már létezik ilyen névvel vagy e-mail címmel admin.', 'danger', '/admin', null);
			}

			$admin = $this->Model->selectByRecord('admins', 'name', $name, PDO::PARAM_STR);

			if (!$admin || !password_verify($pw, $admin->password)) {
				$_SESSION['login_admin_prev'] = $_POST;
				return Toast::set('Hibás e-mail cím vagy jelszó, kérjük próblja újra.', 'danger', '/admin', null);
			}


			if ($admin->id) {
				session_write_close();
				$session_timeout = 6000;
				session_set_cookie_params($session_timeout, '/', '', true, true);
				session_start();
				session_regenerate_id(true);
				$_SESSION['adminId'] = $admin->id;

				if (isset($_SESSION['add_admin_prev'])) unset($_SESSION['add_admin_prev']);
				if (isset($_SESSION['add_admin_errors'])) unset($_SESSION['add_admin_errors']);

				return Toast::set('Bejelentkezés sikeres!', 'teal-500', '/admin/dashboard', null);
			} else {
				Toast::set('Sikertelen belépés, hibás felhasználónév vagy jelszó', 'rose-500', '/admin', null);
			}
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}
}

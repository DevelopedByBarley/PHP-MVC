<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminActivity;
use Exception;

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
            $is_success = $this->Admin->storeAdmin($_POST);

            if (!isset($admin['status']) && $is_success['status'] !== false) {
                $this->Activity->store([
                    'content' => "Új admint adott hozzá: " . $_POST['name'] . ", level(" . $_POST['level'] . ")",
                    'contentInEn' => null,
                    'adminRefId' => $_SESSION['adminId']
                ], $_SESSION['adminId']);

                /* 
          $this->Mailer->renderAndSend('NewAdmin', [
            'admin_name' => $admin['name'] ?? 'problem',
            'site_url' => 'http://localhost:8080' ?? 'problem',
            'admin_password' => $_POST['password'] ?? 'problem'
          ], $admin['email'], 'Hello');
           */

                $this->Mailer->renderAndSend('NewAdmin', [
                    'admin_name' => $_POST['name'] ?? 'problem',
                    'site_url' => 'http://localhost:8080' ?? 'problem',
                    'admin_password' => $_POST['password'] ?? 'problem'
                ], $_POST['email'], 'Hello');

                $this->Toast->set('Admin sikeresen hozzáadva', 'success', '/admin/settings', null);
            } else {
                $this->Toast->set($is_success['message'], 'danger', '/admin/settings', null);
            }
        } catch (Exception $e) {
            // Log the exception instead of echoing it
            error_log($e->getMessage());
            $this->Toast->set('Hiba történt az admin hozzáadásakor.', 'danger', '/admin/settings', null);
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
        try {
            $adminId = $this->Admin->loginAdmin($_POST);

            if ($adminId) {
                session_write_close(); // Bezárjuk a sessiont
                $session_timeout = 6000;
                session_set_cookie_params($session_timeout, '/', '', true, true); // secure és httponly flag beállítása
                session_start();
                session_regenerate_id(true);
                $_SESSION['adminId'] = $adminId;
                header('Location: /admin/dashboard');
                exit;
            } else {
                $this->Toast->set('Sikertelen belépés, hibás felhasználónév vagy jelszó', 'rose-500', '/admin', null);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

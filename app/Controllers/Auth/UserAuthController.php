<?php

namespace App\Controllers\Auth;


use App\Controllers\Controller;
use App\Helpers\Alert;
use App\Helpers\FileSaver;
use App\Helpers\Log;
use App\Helpers\Render;
use App\Helpers\Toast;
use App\Helpers\Validator;
use App\Models\User;
use Exception;
use PDO;

class UserAuthController extends Controller
{
    private $User;

    public function __construct()
    {
        $this->User = new User();
        parent::__construct();
    }

    public function registerPage()
    {
        session_start();


        $userId = $_SESSION["userId"] ?? null;

        if ($userId) {
            header("Location: /user/dashboard");
            exit;
        }


        echo Render::write("public/Layout.php", [
            "user" => $this->Model->show('users', $userId),
            "content" => Render::write("public/pages/user/Register.php", [
                "csrf" => $this->CSRFToken,
                "errors" => $_SESSION['errors'] ?? null,
                "prev" => $_SESSION['prev'] ?? null
            ])
        ]);
    }

    public function loginPage()
    {
        session_start();

        $userId = $_SESSION["userId"] ?? null;

        if ($userId) {
            header("Location: /user/dashboard");
            exit;
        }


        echo Render::write("public/Layout.php", [
            "user" => $this->Model->show('users', $userId),
            "content" => Render::write("public/pages/user/Login.php", [
                "csrf" => $this->CSRFToken
            ])
        ]);
    }


    public function store()
    {
        session_start();
        $this->CSRFToken->check();

        $validators  = [
            'name' => ['required' => true, 'split' => true, 'minLength' => 5, 'maxLength' => 50],
            'email' => ['required' => true, 'minLength' => 5, 'maxLength' => 30, 'email' => true, 'unique' => ['users', 'email', PDO::PARAM_STR]],
            'password' => ['required' => true, 'password' => true, 'minLength' => 5, 'maxLength' => 50]
        ];

        $errors = Validator::validate($validators);


        if (!empty($errors)) {
            if (isset($_POST['csrf'])) unset($_POST['csrf']);
            $_SESSION['prev'] = $_POST;
            $_SESSION['errors'] = $errors;
            Log::info("Register validation fail: " . json_encode($errors, JSON_UNESCAPED_UNICODE));
            Toast::set('Hibás adatok, kérjük próbálja meg más adatokkal', 'danger', '/user/register', null);
            exit;
        }


        if (!empty($_FILES['file']['name'])) {
            $fileName = FileSaver::saver($_FILES['file'], '/uploads/images/', ['1688134460671231c4eae175.49361389.png'], null);
        }


        try {
            $userId = $this->User->storeUser($_POST, $fileName);
            if (!$userId) {
                FileSaver::unLinkImagesForFail('/uploads/images/', $fileName);
                Log::info("Registraion is failed with email: " . $_POST['email']);
                return Toast::set('Regisztráció sikertelen, próbálja meg más adatokkal!', 'danger', '/user/register', null);
            }

            if (isset($_SESSION['prev'])) unset($_SESSION['prev']);
            if (isset($_SESSION['errors'])) unset($_SESSION['errors']);
            Log::info("User registered successfully with email: " . $_POST['email'] . ", id: $userId");
            return Alert::set('Regisztráció sikeres!', 'Regisztráció sikeresen megtörtént, mostmár bejelentkezhet', 'teal-500', '/user/login', null);
        } catch (Exception $e) {
            Toast::set('Regisztráció sikertelen, általános szerver hiba', 'red-500', '/user/register', null);
            Log::error("Internal Server Error", $e->getMessage() . "\n" . $e->getTraceAsString());
        }
    }

    public function login()
    {
        try {
            $this->CSRFToken->check();

            $email = filter_var($_POST["email"] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
            $pw = filter_var($_POST["password"] ?? '', FILTER_SANITIZE_EMAIL);

            $user = $this->Model->selectByRecord('users', 'email', $email, PDO::PARAM_STR);

            if (!$user || !password_verify($pw, $user->password)) {
                Log::info($email . " User login failed, e-mail or password problem");
                return Toast::set('Bejelentkezés sikertelen, e-mail vagy jelszó hibás', 'red-500', '/user/login', null);
            }

            if ($user->id) {
                session_write_close(); // Bezárjuk a sessiont
                $session_timeout = 6000;
                session_set_cookie_params($session_timeout, '/', '', true, true); // secure és httponly flag beállítása
                session_start();
                session_regenerate_id(true);
                $_SESSION['userId'] = $user->id;
                Log::info("$email  user width id: $user->id logged in successfully!");
                return Toast::set('Bejelentkezés sikertelen, e-mail vagy jelszó hibás', 'teal-500', '/user/dashboard', null);
                exit;
            } else {
                Toast::set('Hibás e-mail cím vagy jelszó!', 'danger', '/user/login', null);
            }
        } catch (Exception $e) {
            http_response_code(500);
            Log::error("Internal Server Error", $e->getMessage() . "\n" . $e->getTraceAsString());
            Toast::set('Általános szerver hiba.', 'danger', '/user/login', null);
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

            header("Location: /user/login");
            exit;
        } catch (Exception $e) {
            Log::error("Internal Server Error", $e->getMessage() . "\n" . $e->getTraceAsString());
            Toast::set('Általános szerver hiba.', 'danger', '/', null);
        }
    }
}

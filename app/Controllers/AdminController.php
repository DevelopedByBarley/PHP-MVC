<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Admin;

class AdminController extends Controller
{
  private $Admin;

  public function __construct()
  {
    $this->Admin = new Admin();
    parent::__construct();
  }


  public function loginPage()
  {
    session_start();

    $admin = $_SESSION["adminId"] ?? null;

    if ($admin) {
      header("Location: /admin/dashboard");
      exit;
    }


    echo $this->Render->write("admin/Layout.php", [
      "content" => $this->Render->write("admin/pages/Login.php", [
        "csfr" => $this->CSFRToken
      ])
    ]);
  }

  public function store()
  {
    $this->CSFRToken->check();
    $this->Admin->storeAdmin($_POST);
  }

  public function login()
  {
    $this->CSFRToken->check();
    session_start();

    $isSuccess = $this->Admin->loginAdmin($_POST);

    if ($isSuccess) {
      $session_timeout = 5;
      session_set_cookie_params($session_timeout, '/', '', true, true); // secure és httponly flag beállítása
      session_regenerate_id(true);
    }

    self::redirectByState($isSuccess, '/admin/dashboard', '/admin');
  }




  public function logout()
  {
    
    $this->CSFRToken->check();
    session_start();
    session_destroy();
    session_regenerate_id(true);

    $cookieParams = session_get_cookie_params();
    setcookie(session_name(), "", 0, $cookieParams["path"], $cookieParams["domain"], $cookieParams["secure"], isset($cookieParams["httponly"]));

    header("Location: /admin");
  }

  public function index()
  {
    $this->Auth::checkUserIsLoggedInOrRedirect('adminId', '/admin');


    echo $this->Render->write("admin/Layout.php", [
      "content" => $this->Render->write("admin/pages/Dashboard.php", [
        "csfr" => $this->CSFRToken
      ])
    ]);
  }
}

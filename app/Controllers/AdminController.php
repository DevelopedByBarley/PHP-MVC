<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminActivity;
use Exception;
use PDO;

class AdminController extends Controller
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
      $this->Admin->storeAdmin($_POST);
      $this->Toast->set('Admin sikeresen hozzáadva', 'success', '/admin/settings', null);
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }
  public function update()
  {
    $this->CSRFToken->check();
    $adminId = $this->Auth::checkUserIsLoggedInOrRedirect('adminId', '/admin');
    try {
      $admin = $this->Admin->updateAdmin($adminId, $_POST);

      if ($admin) {
        $this->Toast->set('Admin sikeresen frissítve', 'success', '/admin/settings', null);
      } else {
        $this->Toast->set('Admin frissítése sikretelen, rosszul adta meg előző jelszavát!', 'danger', '/admin/settings', null);
      }
    } catch (Exception $e) {
      echo $e->getMessage();
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
        $this->Toast->set('Sikertelen belépés, hibás felhasználónév vagy jelszó', 'danger', '/admin', null);
      }
    } catch (Exception $e) {
      echo $e->getMessage();
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




























  /**
   * @param RENDERS --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
   */



  public function index()
  {
    $adminId = $this->Auth::checkUserIsLoggedInOrRedirect('adminId', '/admin');
    $admin = $this->Model->selectByRecord('admins', 'id', $adminId, PDO::PARAM_INT);
    $visitors = $this->Model->all('visits');
    $admin_list = ADMIN_SERVICE_PERM ? $this->Model->all('admins') : [];
    $users =  USER_SERVICE_PERM ? $this->Model->all('users') : [];
    $feedbacks = $this->Model->all('feedbacks');

    $admin_activities = $this->Activity->getAdminActivities();
    $data = [
      'numOfPage' => 10,
    ];

    echo $this->Render->write("admin/Layout.php", [
      "csrf" => $this->CSRFToken,
      "content" => $this->Render->write("admin/pages/Dashboard.php", [
        'admin_list' => $admin_list,
        'admin' => $admin,
        'admin_activities' => $admin_activities,
        'feedbacks' => $feedbacks,
        'visitors' => $visitors,
        'users' => $users,
        'data' => $data
      ])
    ]);
  }


  public function loginPage()
  {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }

    $admin = $_SESSION["adminId"] ?? null;

    if ($admin) {
      header("Location: /admin/dashboard");
      exit;
    }

    echo $this->Render->write("admin/Layout.php", [
      "csrf" => $this->CSRFToken,
      "content" => $this->Render->write("admin/pages/Login.php", [
        "csrf" => $this->CSRFToken
      ])
    ]);
  }


  public function table()
  {
    $this->Auth::checkUserIsLoggedInOrRedirect('adminId', '/admin');

    $data = [
      'numOfPage' => 10,
    ];

    echo $this->Render->write("admin/Layout.php", [
      "csrf" => $this->CSRFToken,
      "content" => $this->Render->write("admin/pages/Table.php", [
        'data' => $data
      ])
    ]);
  }
  public function form()
  {
    $this->Auth::checkUserIsLoggedInOrRedirect('adminId', '/admin');

    $data = [
      'numOfPage' => 10,
    ];

    echo $this->Render->write("admin/Layout.php", [
      "csrf" => $this->CSRFToken,
      "content" => $this->Render->write("admin/pages/Form.php", [
        'data' => $data
      ])
    ]);
  }
  public function settings()
  {
    $adminId = $this->Auth::checkUserIsLoggedInOrRedirect('adminId', '/admin');

    $admin = $this->Model->selectByRecord('admins', 'id', $adminId, PDO::PARAM_STR);
    $admin_list = $this->Model->all('admins', $adminId, PDO::PARAM_STR);

    $data = $this->Model->paginate($admin_list, 2, '',  function ($offset, $numOfPages) {
      if ($offset === 0) {
        header("Location: /admin/settings");
        exit;
      }

      if ((int)$offset > (int)$numOfPages) {
        header("Location: /admin/settings?offset=$numOfPages");
        exit;
      }
    });





    echo $this->Render->write("admin/Layout.php", [
      "csrf" => $this->CSRFToken,
      "content" => $this->Render->write("admin/pages/Settings.php", [
        "csrf" => $this->CSRFToken,
        'data' => $data,
        'admin' => $admin,
        'data' => $data
      ])
    ]);
  }
  public function mailbox()
  {
    $this->Auth::checkUserIsLoggedInOrRedirect('adminId', '/admin');

    $data = [
      'numOfPage' => 10,
    ];

    echo $this->Render->write("admin/Layout.php", [
      "csrf" => $this->CSRFToken,
      "content" => $this->Render->write("admin/pages/MailBox.php", [
        'data' => $data
      ])
    ]);
  }
}

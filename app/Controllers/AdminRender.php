<?php

namespace App\Controllers;

use App\Models\Admin;
use Exception;
use PDO;

class AdminRender extends AdminController
{
  private $Admin;

  public function __construct()
  {
    $this->Admin = new Admin();
    parent::__construct();
  }


  public function index()
  {
    $this->Auth::checkUserIsLoggedInOrRedirect('adminId', '/admin');

    $data = [
      'numOfPage' => 10,
    ];

    echo $this->Render->write("admin/Layout.php", [
      "csrf" => $this->CSRFToken,
      "content" => $this->Render->write("admin/pages/Dashboard.php", [
        'data' => $data
      ])
    ]);
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

    $admin = $this->Model->selectByRecord('admins', 'adminId', $adminId, PDO::PARAM_STR);

    $data = [
      'numOfPage' => 10,
    ];

    

    echo $this->Render->write("admin/Layout.php", [
      "csrf" => $this->CSRFToken,
      "content" => $this->Render->write("admin/pages/Settings.php", [
        'data' => $data,
        'admin' => $admin
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

<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\User;
use Exception;
use PDO;

class UserController extends Controller
{
  private $User;

  public function __construct()
  {
    $this->User = new User();
    parent::__construct();
  }


  public function index()
  {
    $userId = $this->Auth->checkUserIsLoggedInOrRedirect('userId', '/user/login');
    $user = $this->Model->show('users', $userId);

    echo $this->Render->write("public/Layout.php", [
      "csrf" => $this->CSRFToken,
      "user" => $user,
      "content" => $this->Render->write("public/pages/user/Dashboard.php", [
        "user" => $user,
      ])
    ]);
  }
}

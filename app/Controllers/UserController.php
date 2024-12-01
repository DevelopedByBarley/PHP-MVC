<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Helpers\Render;
use App\Models\User;
use App\Services\Auth;
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
    $userId = Auth::checkUserIsLoggedInOrRedirect('userId', '/user/login');
    $user = $this->Model->show('users', $userId);

    echo Render::write("public/Layout.php", [
      "csrf" => $this->CSRFToken,
      "user" => $user,
      "content" => Render::write("public/pages/user/Dashboard.php", [
        "user" => $user,
      ])
    ]);
  }
}

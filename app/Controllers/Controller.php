<?php

namespace App\Controllers;

use App\Helpers\{Alert, Authenticate, CSRFToken, FileSaver, Mailer, Render, Toast, UUID, Validator, XLSX};
use App\Models\{Model};


class Controller
{
  protected $Model;
  protected $Auth;
  protected $Render;
  protected $XLSX;
  protected $UUID;
  protected $Alert;
  protected $Toast;
  protected $CSRFToken;
  protected $Mailer;
  protected $Validator;
  protected $FileSaver;


  public function __construct()
  {
    $this->Model = new Model();
    $this->Auth = new Authenticate();
    $this->Render = new Render();
    $this->XLSX = new XLSX();
    $this->UUID = new UUID();
    $this->Alert = new Alert();
    $this->Toast = new Toast();
    $this->CSRFToken = new CSRFToken();
    $this->Mailer = new Mailer();
    $this->Validator = new Validator();
    $this->FileSaver = new FileSaver();
  }



  public function home(): void
  {
    $userId = $this->Auth->checkUserIsLoggedInOrRedirect('userId', '/user/login');
    $user = $this->Model->show('users', $userId);

    echo $this->Render->write("public/Layout.php", [
      "title" => "Welcome",
      "csrf" => $this->CSRFToken,
      "user" => $user,
      "meta_tags" => WELCOME_META_TAGS,
      "content" => $this->Render->write("public/pages/Main.php", [
        "lang" => strtolower($_COOKIE['lang'])
      ])
    ]);
  }
  public function cookie()
  {
    echo $this->Render->write("public/Layout.php", [
      "content" => $this->Render->write("public/pages/Cookie_Info.php", [])
    ]);
  }

  public function error()
  {
    echo $this->Render->write("public/Layout.php", [
      "content" => $this->Render->write("public/pages/404.php", [])
    ]);
  }



  public function redirectByState($isSuccess, $success_url, $failed_url)
  {
    if ($isSuccess) {
      header("Location: $success_url");
      exit;
    } else {
      header("Location: $failed_url");
      exit;
    }
  }

  protected function getIpByUser()
  {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
      return $_SERVER['REMOTE_ADDR'];
    }
  }

  protected function setCookieWithExpiry($name, $value, $expiry)
  {
    $expiryTime = time() + ($expiry);
    setcookie($name, $value, $expiryTime, "/");
  }
}

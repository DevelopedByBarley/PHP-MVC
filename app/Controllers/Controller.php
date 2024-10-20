<?php

namespace App\Controllers;

use App\Helpers\{Alert, Authenticate, CSRFToken, Debug, FileSaver, Mailer, Render, Toast, UUID, Validator, XLSX};
use App\Models\{Model, Visitor};



class Controller
{
  protected $Model;
  protected $Debug;
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
    $this->Debug = new Debug();
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

  public function test(): void {}

  public function home(): void
  {

    $visitor = new Visitor();

    $is_admin_url = strpos($_SERVER['REQUEST_URI'], '/admin') !== false;

    if (defined('SAVING_VISITOR_PERM') && SAVING_VISITOR_PERM && !$is_admin_url) {
      $visitor->addVisitor();
    }


    echo $this->Render->write("public/Layout.php", [
      "title" => "Welcome",
      "meta_tags" => WELCOME_META_TAGS,
      "content" => $this->Render->write("public/pages/Welcome.php", [
        "lang" => $_COOKIE['lang']
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


  public function createResetUrl($tokenData)
  {
    return APP_URL . '/reset?token=' . urlencode($tokenData['token']) . '&expires=' . urlencode($tokenData['expires']);
  }

  public function generateExpiresTokenByDays($days)
  {
    $token = bin2hex(random_bytes(16));
    $expires = time() + ($days * 24 * 60 * 60);
    return [
      'token' => $token,
      'expires' => $expires,
    ];
  }

  public function generateExpiresTokenByHours($hours)
  {
    $token = bin2hex(random_bytes(16));
    $expires = time() + ($hours * 60 * 60);
    return [
      'token' => $token,
      'expires' => $expires,
    ];
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

<?php

namespace App\Controllers;

use App\Helpers\{CSRFToken, Render};
use App\Models\{Model};


class Controller
{
  protected $Model;
  protected $CSRFToken;


  public function __construct()
  {
    $this->Model = new Model();
    $this->CSRFToken = new CSRFToken();
  }



  public function home(): void
  {
    session_start();
    $userId =  $_SESSION['userId'] ?? null;
    $user = $this->Model->show('users', $userId);

    echo Render::write("public/Layout.php", [
      "title" => "Welcome",
      "csrf" => $this->CSRFToken,
      "user" => $user,
      "meta_tags" => WELCOME_META_TAGS,
      "content" => Render::write("public/pages/Main.php", [
        "lang" => strtolower($_COOKIE['lang'])
      ])
    ]);
  }
  public function cookie()
  {
    echo Render::write("public/Layout.php", [
      "content" => Render::write("public/pages/Cookie_Info.php", [])
    ]);
  }

  public function error()
  {
    session_start();
    $userId =  $_SESSION['userId'] ?? null;
    $user = $this->Model->show('users', $userId);

    echo Render::write("public/Layout.php", [
      "csrf" => $this->CSRFToken,
      "user" => $user,
      "content" => Render::write("public/pages/404.php", [])
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
}

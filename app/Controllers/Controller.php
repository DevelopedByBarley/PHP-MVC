<?php

namespace App\Controllers;

use App\Helpers\Alert;
use App\Helpers\Authenticate;
use App\Helpers\CSRFToken;
use App\Helpers\Debug;
use App\Helpers\Render;
use App\Helpers\Toast;
use App\Helpers\UUID;
use App\Helpers\XLSX;
use App\Models\Model;
use App\Models\Visitor;

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
  }



  public function testMail()
  {
    $this->Model->sendMail();
  }
  public function test()
  {
    $visitor = new Visitor();

    $is_admin_url = strpos($_SERVER['REQUEST_URI'], '/admin') !== false;

    // Ellenőrizd, hogy a SAVING_VISITOR_PERM definiálva van-e és igaz-e
    if (defined('SAVING_VISITOR_PERM') && SAVING_VISITOR_PERM && !$is_admin_url) {
      $visitor->addVisitor();
    }


    echo $this->Render->write("public/Layout.php", [
      "content" => $this->Render->write("public/pages/Test.php", [])
    ]);
  }


  public function index()
  {
    echo $this->Render->write("public/Layout.php", [
      "content" => $this->Render->write("public/pages/Welcome.php", [])
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
}

<?php

namespace App\Helpers;


class Toast
{
  // SET ALERT
  public static function set($message, $bg, $location, $messageInEng = null)
  {

    if (session_id() == '') {
      session_start();
    }

    $lang = isset($_COOKIE["lang"]) ? strtolower($_COOKIE["lang"]) : null;

    if ($lang === "hu") {
      $_SESSION["toast"] = [
        "message" => $message,
        "bg" => $bg,
        "color" => 'white',
        "time" => 'most',
        "expires" => time() + 2,
      ];
    } else if ($lang === "en") {
      $_SESSION["toast"] = [
        "message" => $messageInEng,
        "bg" => $bg,
        "expires" => time() + 2
      ];
    } else {
      // Hibakezelés, ha a nyelv nem "Hu" vagy "En"
      echo "Hiba: Ismeretlen nyelv!";
      exit;
    }


    header("Location: $location");
    exit;
  }
}

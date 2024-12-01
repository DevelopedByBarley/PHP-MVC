<?php

namespace App\Helpers;

class Render
{
  public static function write($path, $params = []): string
  {
    ob_start();

    extract($params);

    $filePath = dirname(__DIR__, 2) . "/app/Views/" . $path;

    if (!file_exists($filePath)) {
      echo 'This file is doesnt exist!';
      throw new \Exception("View file not found: " . $filePath);
    }

    require $filePath;

    $output = ob_get_clean();

    if (!headers_sent()) {
      header("Content-Type: text/html; charset=UTF-8");
    }

    return $output;
  }
}

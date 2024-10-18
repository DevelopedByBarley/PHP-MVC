<?php

namespace App\Helpers;

class Render
{
  public function write($path, $params = [], $rewriteURL = false): string
  {
    ob_start();

    extract($params);

    if (!$rewriteURL) {
      require dirname(__DIR__, 2) . "/app/Views/" . $path;
      return ob_get_clean();
    } else {
      require $rewriteURL;
      return ob_get_clean();
    }
  }
}

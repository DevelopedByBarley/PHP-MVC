<?php

namespace App\Helpers;

class Log
{
  public static function log($level, $message, $dev, $logFile = 'storage/logs/app.log')
  {
    $timestamp = date('Y-m-d H:i:s');
    $logMessage = "[{$timestamp}] {$level}: {$message}" . PHP_EOL;

    if ($dev !== null) {
      $logMessage .= "[DEV] {$dev}" . PHP_EOL;
    }

    file_put_contents($logFile, $logMessage, FILE_APPEND);
  }


  public static function info($message, $dev = null)
  {
    self::log('INFO', $message, $dev);
  }

  public static function error($message,  $dev = null)
  {
    self::log('ERROR', $message, $dev);
  }

  public static function warning($message,  $dev = null)
  {
    self::log('WARNING', $message, $dev);
  }
}

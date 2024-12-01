<?php

namespace App\Helpers;

class Log
{
  public static function log($level, $logFile, $message, $dev)
  {
    $timestamp = date('Y-m-d H:i:s');
    $logMessage = "[{$timestamp}] {$level}: {$message}" . PHP_EOL;

    if ($dev !== null) {
      $logMessage .= "[DEV] {$dev}" . PHP_EOL;
    }

    file_put_contents("storage/logs/$logFile.log", $logMessage, FILE_APPEND);
  }


  public static function info($logFile, $message, $dev = null)
  {
    self::log('INFO', $logFile, $message, $dev);
  }

  public static function error($logFile, $message,  $dev = null)
  {
    self::log('ERROR', $logFile, $message, $dev);
  }

  public static function warning($logFile, $message,  $dev = null)
  {
    self::log('WARNING', $logFile, $message, $dev);
  }
}

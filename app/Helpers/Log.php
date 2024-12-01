<?php

namespace App\Helpers;

class Log
{
  public static function log($level, $message, $logFile = 'storage/logs/app.log')
  {
    $timestamp = date('Y-m-d H:i:s');
    $logMessage = "[{$timestamp}] {$level}: {$message}" . PHP_EOL;
    file_put_contents($logFile, $logMessage, FILE_APPEND);
  }

  public static function info($message)
  {
    self::log('INFO', $message);
  }

  public static function error($message)
  {
    self::log('ERROR', $message);
  }

  public static function warning($message)
  {
    self::log('WARNING', $message);
  }
}

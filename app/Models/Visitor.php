<?php

namespace App\Models;

use PDO;
use PDOException;
use Exception;

class Visitor extends Model
{

  public function addVisitor()
  {
    try {
      $ip = self::getUserIP();

      // Ellenőrizzük, hogy az IP cím már szerepel-e az adatbázisban
      $checkStmt = $this->Pdo->prepare("SELECT COUNT(*) FROM visits WHERE ip_address = :ip_address");
      $checkStmt->bindParam(':ip_address', $ip, PDO::PARAM_STR);
      $checkStmt->execute();
      $count = $checkStmt->fetchColumn();

      if ($count == 0) {
        // Ha az IP cím még nem szerepel az adatbázisban, mentjük az adatokat
        $browser = self::getUserBrowser();
        $operatingSystem = php_uname('s');
        $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'Direct';
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $pageUrl = $_SERVER['REQUEST_URI'];
        $deviceType = $this->getDeviceType($userAgent);
        $country = $this->getCountryFromIP($ip);

        $stmt = $this->Pdo->prepare(
          "INSERT INTO visits (ip_address, visit_time, browser, operating_system, referrer, device_type, page_url, country)
                  VALUES (:ip_address, current_timestamp(), :browser, :operating_system, :referrer, :device_type, :page_url, :country)"
        );
        $stmt->bindParam(':ip_address', $ip, PDO::PARAM_STR);
        $stmt->bindParam(':browser', $browser, PDO::PARAM_STR);
        $stmt->bindParam(':operating_system', $operatingSystem, PDO::PARAM_STR);
        $stmt->bindParam(':referrer', $referrer, PDO::PARAM_STR);
        $stmt->bindParam(':device_type', $deviceType, PDO::PARAM_STR);
        $stmt->bindParam(':page_url', $pageUrl, PDO::PARAM_STR);
        $stmt->bindParam(':country', $country, PDO::PARAM_STR);

        $stmt->execute();
      }
    } catch (PDOException $e) {
      throw new Exception("An error occurred during the database operation in addVisitor method in Visitor model: " . $e->getMessage());
    }
  }

  private function getDeviceType($userAgent)
  {
    if (preg_match('/mobile|android|iphone|ipod/i', $userAgent)) {
      return 'Mobile';
    } elseif (preg_match('/tablet|ipad/i', $userAgent)) {
      return 'Tablet';
    } elseif (preg_match('/laptop|notebook/i', $userAgent)) {
      return 'Laptop';
    } else {
      return 'Desktop';
    }
  }

  private function getCountryFromIP($ip)
  {
    if ($ip == '127.0.0.1' || $ip == '::1') {
      return 'Localhost';
    }

    $accessKey = 'YOUR_ACCESS_KEY'; // Cseréld ki a saját API kulcsodra
    $url = "http://ipinfo.io/{$ip}/country?token={$accessKey}";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $country = curl_exec($ch);
    curl_close($ch);

    return $country ? trim($country) : 'Unknown';
  }

  private function getUserIP()
  {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
      return $_SERVER['REMOTE_ADDR'];
    }
  }

  // Funkció a felhasználó böngészőjének lekérdezésére
  private function getUserBrowser()
  {
    return $_SERVER['HTTP_USER_AGENT'];
  }
}

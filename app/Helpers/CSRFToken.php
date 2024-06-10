<?php

namespace App\Helpers;

class CSRFToken
{
  private $secretKey;
  private $tokenLifetime; // Token élettartama másodpercekben

  public function __construct($tokenLifetime = 10) // Alapértelmezett élettartam: 1 óra
  {
    $this->secretKey = $_SERVER["CSRF_SECRET"];
    $this->tokenLifetime = $tokenLifetime;
  }

  public function token()
  {

    // SESSION INDITÁSA HA NINCS
    if (session_id() == '') {
      session_start();
    }

    self::removeExpiredTokens();


    if (isset($_SESSION['csrf'])) unset($_SESSION['csrf']);


    // Generálunk egy véletlenszerű token-t
    $token = bin2hex(random_bytes(32)); // Erősebb véletlenszerű token generálás

    // Kódoljuk a token-t a titkos kulcs segítségével
    $encodedToken = hash_hmac('sha256', $token, $this->secretKey);

    // Tároljuk el a kódolt token-t a session-ben, de előtte ellenőrizzük, hogy a session-ben már van-e csrf tömb
    if (isset($_SESSION['csrf']) && is_array($_SESSION['csrf'])) {
      $_SESSION['csrf'] = [
        'token' => $encodedToken,
        'expiry' => $this->tokenLifetime +  time()
      ];
    } else {
      // Ha még nincs csrf tömb a session-ben, akkor hozzunk létre újat és tegyük bele a generált tokent
      $_SESSION['csrf'] = [[
        'token' => $encodedToken,
        'expiry' => time() + $this->tokenLifetime
      ]];
    }

    // Tároljuk el a kódolt token-t a visszatérési értékben
    return $token;
  }


  public function generate()
  {
    if (session_id() == '') {
      session_start();
    }

    self::removeExpiredTokens();


    // Generálunk egy véletlenszerű token-t
    $token = bin2hex(random_bytes(32)); // Erősebb véletlenszerű token generálás

    // Kódoljuk a token-t a titkos kulcs segítségével
    $encodedToken = hash_hmac('sha256', $token, $this->secretKey);

    // Tároljuk el a kódolt token-t a session-ben, de előtte ellenőrizzük, hogy a session-ben már van-e csrf tömb
    if (isset($_SESSION['csrf']) && is_array($_SESSION['csrf'])) {
      // Ha már van csrf tömb a session-ben, akkor adjuk hozzá a generált tokent
      $_SESSION['csrf'][] =  [
        'token' => $encodedToken,
        'expiry' => time() + $this->tokenLifetime
      ];
    } else {
      // Ha még nincs csrf tömb a session-ben, akkor hozzunk létre újat és tegyük bele a generált tokent
      $_SESSION['csrf'] = [[
        'token' => $encodedToken,
        'expiry' => time() + $this->tokenLifetime
      ]];
    }

    // A token-t használhatjuk a felhasználói felületen, például egy rejtett input mezőként egy űrlapon
    echo "<input type='hidden' name='csrf' value='$token'>";
  }


  public function check()
  {
    if (session_id() == '') {
      session_start();
    }

    if (!isset($_POST['csrf'])) {
      http_response_code(401);
      echo 'Post csrf problem';
      exit;
    }

    if (!isset($_SESSION['csrf'])) {
      var_dump($_SESSION['csrf']);
      http_response_code(401);
      echo 'Session csrf problem';
      exit;
    }

    $postCsrf = $_POST['csrf'];

    // Iteráljunk végig a session CSRF tömbön
    foreach ($_SESSION['csrf'] as $key => $sessionCsrf) {
      $token = hash_hmac('sha256', $postCsrf, $this->secretKey);


      if (hash_equals($sessionCsrf['token'], $token)) {
        unset($_SESSION['csrf'][$key]);
        unset($_SESSION['csrf']);
        break; // Kilépünk a ciklusból, mert megtaláltuk a passzoló CSRF tokent
      }
    }

    // Ha a session-ben többé nincs CSRF token
    if (empty($_SESSION['csrf'])) {
      unset($_SESSION['csrf']); // Töröljük a CSRF tömböt a session-ből
    }

    if (!$this->isSafeOrigin()) {
      http_response_code(403);
      exit('Unsafe origin.');
    }

    return true;
  }


  private function isSafeOrigin()
  {
    // Az elfogadható eredetek listája
    $safeOrigins = array('http://localhost:8080', 'http://localhost:9090', 'http://localhost:3000', 'https://barley-test.hu');

    // Ellenőrizzük az Origin fejlécet
    if (isset($_SERVER['HTTP_ORIGIN'])) {
      $origin = rtrim($_SERVER['HTTP_ORIGIN'], '/');
      if (in_array($origin, $safeOrigins)) {
        return true;
      }
    }

    return false;
  }


  private function removeExpiredTokens()
  {
    $sessions = $_SESSION['csrf'];
    if (isset($sessions)) {
      foreach ($sessions as $index => $session) {
        if ($session['expiry'] < time()) {
          unset($_SESSION['csrf'][$index]);
          if (empty($sessions))   unset($_SESSION['csrf']);
        }
      }
    }
  }
}

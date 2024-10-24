<?php

namespace App\Helpers;

use Database;
use Exception;
use PDO;

/*  
  
 HOW TO USE?
 
 $validators  = [
      'name' => ['validators' => ['required' => true, 'split' => true, 'minLength' => 5, 'maxLength' => 50,]],
      'email' => ['validators' => ['required' => true, 'minLength' => 7, 'maxLength' => 30, 'email' => true]],
      'test' => ['validators' => ['required' => true, 'num' => true]],
    ];


    $validated = $this->Validator->validate( $validators); 
    
    
    
array(3) {
  [0]=>
  array(2) {
    ["validators"]=>
    array(4) {
      ["required"]=>
      bool(true)
      ["split"]=>
      bool(true)
      ["minLength"]=>
      int(5)
      ["maxLength"]=>
      int(50)
    }
    ["name"]=>
    string(4) "name"
  }
  [1]=>
  array(2) {
    ["validators"]=>
    array(4) {
      ["required"]=>
      bool(true)
      ["minLength"]=>
      int(7)
      ["maxLength"]=>
      int(30)
      ["email"]=>
      bool(true)
    }
    ["name"]=>
    string(5) "email"
  }
  [2]=>
  array(2) {
    ["validators"]=>
    array(4) {
      ["required"]=>
      bool(true)
      ["password"]=>
      bool(true)
      ["minLength"]=>
      int(5)
      ["maxLength"]=>
      int(50)
    }
    ["name"]=>
    string(8) "password"
  }
}
    
    */




class Validator
{


  private function structureValidators($validators)
  {
    $ret = [];
    foreach ($validators as $key => $validator) {
      $ret[$key] = $validator;
    }

    return $ret;
  }

  public function validate($validators)
  {
    $ret = [];
    $data = self::structureValidators($validators);



    foreach ($data as $name => $validatorsData) {
      $value = filter_var($_POST[$name], FILTER_SANITIZE_SPECIAL_CHARS);
      foreach ($validatorsData as $validatorName => $validatorValue) {
        $ret[$name][$validatorName] = [
          'status' => $this->{$validatorName}($value, $validatorValue),
          'errorMessage' => !$this->{$validatorName}($value, $validatorValue) ? self::errorMessages($validatorName, $name, $validatorValue) : ''
        ];
      }
    }

    return self::getRecordsWithErrors($ret);
  }


  public function getRecordsWithErrors($validated)
  {
    $ret = [];
    foreach ($validated as $key => $record) {
      foreach ($record as $validator) {
        if (!empty($validator['errorMessage'])) $ret[$key][] = $validator['errorMessage'];
      }
    }

    return $ret;
  }

  public function hasValidateErrors($data)
  {
    foreach ($data as $value) {
      if (is_array($value)) {
        if (isset($value['status']) && $value['status'] === false) {
          return true;
        } elseif (self::hasValidateErrors($value)) {
          return true;
        }
      }
    }
    return false;
  }

  public function required($value)
  {
    if (!$value || $value === '') return false;
    return true;
  }

  public function minLength($value, $minLength)
  {
    if (strlen($value) < $minLength) return false;
    return true;
  }

  public function maxLength($value, $maxLength)
  {
    if (strlen($value) > $maxLength) return false;
    return true;
  }

  public function phone($value)
  {
    $cleanValue = preg_replace('/[\s\-]/', '', $value);
    $pattern = '/^(?:\+36|06)\d{9}$/';

    return preg_match($pattern, $cleanValue);
  }

  public function email($value)
  {
    return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
  }



  public function noSpaces($value)
  {
    if (strpos($value, ' ') !== false) return false;
    return true;
  }

  public function num($value)
  {
    if (!is_numeric($value)) return false;
    return true;
  }

  public function hasNum($value)
  {
    return preg_match('/\d/', $value);
  }

  public function hasUppercase($value)
  {
    return preg_match('/[A-Z]/', $value);
  }

  public function split($value)
  {
    $words = explode(' ', trim($value));
    return count($words) >= 2 && strlen($words[1]) > 0;
  }

  public function password($value)
  {
    $hasUpperCase = preg_match('/[A-Z]/', $value);
    $hasLowerCase = preg_match('/[a-z]/', $value);
    $hasNumber = preg_match('/\d/', $value);
    $hasSpecialChar = preg_match('/[!@#$%^&*(),.?":{}|<>]/', $value);
    $isLengthValid = strlen($value) >= 8;

    return $hasUpperCase && $hasLowerCase && $hasNumber && $hasSpecialChar && $isLengthValid;
  }

  public function comparePw($password, $confirmPassword)
  {
    return $password === $confirmPassword;
  }



  public function allowedCharacters($value)
  {
    return preg_match('/^[A-Za-z0-9áéíóöőúüűÁÉÍÓÖŐÚÜŰ\-&\s]+$/u', $value);
  }

  public function unique($value, $data)
  {
    $pdo = Database::getInstance();
    if (!$pdo) {
      throw new Exception("Database connection failed.");
    }

    // Extract table, entity, and param using list() and unpacking
    list($table, $entity, $param) = $data;

    
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM `$table` WHERE `$entity` = :entity");
    $stmt->bindValue(':entity', $value, $param);
    $stmt->execute();

    return $stmt->fetchColumn() === 0; // Returns true if the value is unique
  }




  // Validátor hibaüzenetek frissítése
  public function errorMessages($validator, $field = '', $param = '')
  {
    $lang = $_COOKIE['lang'] ?? null;

    $messages = [
      'required' => [
        'hu' => 'Kitöltés kötelező!',
        'en' => 'This field is required!',
      ],
      'minLength' => [
        'hu' => "A mezőnek legalább {$param} karakter hosszúnak kell lennie.",
        'en' => "The field must be at least {$param} characters long.",
      ],
      'maxLength' => [
        'hu' => "A mező nem lehet hosszabb, mint {$param} karakter.",
        'en' => "The field cannot be longer than {$param} characters.",
      ],
      'phone' => [
        'hu' => "A telefonszám formátuma helytelen.",
        'en' => "The phone number format is incorrect.",
      ],
      'email' => [
        'hu' => "Az e-mail cím formátuma helytelen.",
        'en' => "The email address format is incorrect.",
      ],
      'noSpaces' => [
        'hu' => 'A mező értéke nem tartalmazhat szóközt!',
        'en' => 'The field value cannot contain spaces!',
      ],
      'num' => [
        'hu' => 'A mező értéke csak szám lehet!',
        'en' => 'The field value can only be a number!',
      ],
      'hasNum' => [
        'hu' => 'A mezőnek tartalmaznia kell legalább egy számot!',
        'en' => 'The field must contain at least one number!',
      ],
      'hasUppercase' => [
        'hu' => 'A mezőnek tartalmaznia kell legalább egy nagybetűt!',
        'en' => 'The field must contain at least one uppercase letter!',
      ],
      'split' => [
        'hu' => 'A mezőnek minimum 2 szóból kell állnia.',
        'en' => 'The field must consist of at least 2 words.',
      ],
      'password' => [
        'hu' => 'A jelszónak tartalmaznia kell legalább egy nagybetűt, egy kisbetűt, egy számot és egy speciális karaktert, valamint legalább 8 karakter hosszúnak kell lennie!',
        'en' => 'The password must contain at least one uppercase letter, one lowercase letter, one number, and one special character, and it must be at least 8 characters long!',
      ],
      'comparePw' => [
        'hu' => 'A 2 jelszó nem egyezik meg!',
        'en' => 'The two passwords do not match!',
      ],
      'allowedCharacters' => [
        'hu' => 'A mező csak megengedett karaktereket tartalmazhat (betűk, számok, szóköz, -, &).',
        'en' => 'The field can only contain allowed characters (letters, numbers, space, -, &).',
      ],
      'unique' => [
        'hu' => 'Ezekkel az adatokkal nem tud már regisztrálni, kérjük próbálkozzon más adatokkal.',
        'en' => 'You cannot register with these details, please try using different information.',
      ],
    ];

    return $messages[$validator][$lang];
  }
}

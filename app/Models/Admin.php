<?php

namespace App\Models;

use App\Models\Model;
use Exception;
use PDO;
use PDOException;

class Admin extends Model
{
  public function storeAdmin($body)
  {
    try {
      // Kihagyjuk a CSRF token-t
      $name = filter_var($body["name"] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
      $email = filter_var($body["email"] ?? '', FILTER_SANITIZE_EMAIL);
      $password = password_hash(filter_var($body["password"] ?? '', FILTER_SANITIZE_SPECIAL_CHARS), PASSWORD_DEFAULT);
      $avatar = filter_var($body["avatar-radio"] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);

      $adminId = uniqid(); // Generálunk egy egyedi adminId-t

      // Prepare the SQL statement
      $stmt = $this->Pdo->prepare("INSERT INTO `admins` (`id`, `adminId`, `name`, `email`, `password`, `avatar`, `created_at`) 
                                      VALUES (NULL, :adminId, :name, :email, :password, :avatar, current_timestamp())");

      // Bind parameters to the statement
      $stmt->bindParam(":adminId", $adminId, PDO::PARAM_STR);
      $stmt->bindParam(":name", $name, PDO::PARAM_STR);
      $stmt->bindParam(":email", $email, PDO::PARAM_STR);
      $stmt->bindParam(":password", $password, PDO::PARAM_STR);
      $stmt->bindParam(":avatar", $avatar, PDO::PARAM_STR);

      // Execute the statement
      $stmt->execute();
    } catch (PDOException $e) {
      throw new Exception("An error occurred during the database operation in storeAdmin: " . $e->getMessage());
    }
  }


  public function loginAdmin($body)
  {
    try {
      $name = filter_var($body["name"] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
      $pw = filter_var($body["password"] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);

      $stmt = $this->Pdo->prepare("SELECT * FROM `admins` WHERE `name` = :name");
      $stmt->bindParam(":name", $name, PDO::PARAM_STR);
      $stmt->execute();

      $admin = $stmt->fetch(PDO::FETCH_ASSOC);
      if (!$admin || !password_verify($pw, $admin["password"])) {
        return false;
      }

      return $admin["id"];
    } catch (PDOException $e) {
      throw new Exception("An error occurred during the database operation in LoginAdmin: " . $e->getMessage());
      exit;
    }
  }
}

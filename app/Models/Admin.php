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
      $name = filter_var($body["name"] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
      $email = filter_var($body["email"] ?? '', FILTER_SANITIZE_EMAIL);
      $password = password_hash(filter_var($body["password"] ?? '', FILTER_SANITIZE_SPECIAL_CHARS), PASSWORD_DEFAULT);
      $avatar = filter_var($body["avatar-radio"] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
      $level = filter_var($body["level"] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);

      $adminId = uniqid();

      $stmt = $this->Pdo->prepare("INSERT INTO `admins` (`id`, `adminId`, `level`, `name`, `email`, `password`, `avatar`, `created_at`) 
                                        VALUES (NULL, :adminId, :level, :name, :email, :password, :avatar, current_timestamp())");

      $stmt->bindParam(":adminId", $adminId, PDO::PARAM_STR);
      $stmt->bindParam(":level", $level, PDO::PARAM_INT);
      $stmt->bindParam(":name", $name, PDO::PARAM_STR);
      $stmt->bindParam(":email", $email, PDO::PARAM_STR);
      $stmt->bindParam(":password", $password, PDO::PARAM_STR);
      $stmt->bindParam(":avatar", $avatar, PDO::PARAM_STR);

      $stmt->execute();
      $lastInsertedId = $this->Pdo->lastInsertId();

      return $lastInsertedId;
    } catch (PDOException $e) {
      throw new Exception("An error occurred during the database operation in storeAdmin: " . $e->getMessage());
    }
  }


  public function updateAdmin($adminId, $body, $prev_admin, $child_admin_id)
  {

    try {
      $name = filter_var($body["name"] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
      $password = filter_var($body["password"] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $avatar = filter_var($body["settings_avatar_radio"] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);

      $level = filter_var($body["level"] ?? $prev_admin->level, FILTER_SANITIZE_SPECIAL_CHARS);


      if ($password !== '') {
        $stmt = $this->Pdo->prepare("UPDATE `admins` 
                                           SET `name` = :name, 
                                               `password` = :password, 
                                               `level` = :level, 
                                               `avatar` = :avatar 
                                           WHERE `id` = :adminId");
        $stmt->bindParam(":password", $hash, PDO::PARAM_STR);
      } else {
        $stmt = $this->Pdo->prepare("UPDATE `admins` 
                                           SET `name` = :name, 
                                               `level` = :level, 
                                               `avatar` = :avatar 
                                           WHERE `id` = :adminId");
      }

      $stmt->bindParam(":adminId", $adminId, PDO::PARAM_INT);
      $stmt->bindParam(":name", $name, PDO::PARAM_STR);
      $stmt->bindParam(":level", $level, PDO::PARAM_INT);
      $stmt->bindParam(":avatar", $avatar, PDO::PARAM_STR);

      $stmt->execute();

      return true;
    } catch (PDOException $e) {
      throw new Exception("An error occurred during the database operation in updateAdmin: " . $e->getMessage());
    }
  }
}

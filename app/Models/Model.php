<?php

namespace App\Models;

use App\Helpers\Log;
use Database;
use Exception;
use PDO;
use PDOException;

class Model
{
  protected $Pdo;


  public function __construct()
  {
    DATABASE_PERM === 1 ? $this->Pdo = Database::getInstance() : null;
  }


  public function storeToken($token, $expires, $link, $ref_id)
  {
    try {
      $stmt = $this->Pdo->prepare("INSERT INTO `token` VALUES (NULL, :token, :expires, :link, :ref_id, current_timestamp());");
      $stmt->bindParam(":token", $token);
      $stmt->bindParam(":expires", $expires);
      $stmt->bindParam(":link", $link);
      $stmt->bindParam(":ref_id", $ref_id);
      $stmt->execute();

      return $link;
    } catch (PDOException $e) {
      Log::error('app', "Internal Server Error", $e->getMessage() . "\n" . $e->getTraceAsString());
      throw new Exception("An error occurred during the database operation in the storeToken method: " . $e->getMessage());
    }
  }

  public function checkResetToken()
  {
    $token = $_GET['token'] ?? '';
    $expires = $_GET['expires'] ?? '';

    if (empty($token) || empty($expires)) {
      return false;
    }

    if (time() > (int)$expires) {
      return false;
    }

    try {
      $stmt = $this->Pdo->prepare("SELECT * FROM token WHERE token = :token");
      $stmt->execute(['token' => $token]);

      if ($stmt->rowCount() > 0) {
        $token = $stmt->fetch(PDO::FETCH_OBJ);
        return $token;
      } else {
        return false;
      }
    } catch (PDOException $e) {
      Log::error('app', "Internal Server Error", $e->getMessage() . "\n" . $e->getTraceAsString());
      throw new Exception("An error occurred during the database operation in the checkResetToken method: " . $e->getMessage());
    }
  }


  public function deactivateResetToken($token)
  {
    try {
      $stmt = $this->Pdo->prepare("UPDATE token SET expires = -1 WHERE token = :token");
      $stmt->execute(['token' => $token]);

      if ($stmt->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
    } catch (PDOException $e) {
      Log::error('app', "Internal Server Error", $e->getMessage() . "\n" . $e->getTraceAsString());
      throw new Exception("An error occurred during the database operation in the deactivateResetToken method: " . $e->getMessage());
    }
  }






  public function searchBySingleEntity($table, $entity, $searched, $searchDefault)
  {
    $search = $searched ?? $searchDefault;
    try {
      $searched = "%" . $search . "%"; // $searched előállítása
      $stmt = $this->Pdo->prepare("SELECT * FROM `$table` WHERE `$entity` LIKE :searched");
      $stmt->bindParam(":searched", $searched);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_OBJ);

      return $data;
    } catch (PDOException $e) {
      Log::error('app', "Internal Server Error", $e->getMessage() . "\n" . $e->getTraceAsString());
      throw new Exception("An error occurred during the database operation in the searchBySingleEntity method: " . $e->getMessage());
    }
  }


  public function paginate($results, $limit, $search = '', $searchCondition = null)
  {
    if (empty($results)) {
      return (object)[
        "status" => true,
        "pages" => [],
        "numOfPage" => 0,
        "limit" => 0
      ];
    }




    $offset = isset($_GET["offset"]) ? (int)$_GET["offset"] : null;


    $calculated = ($offset - 1) * $limit;
    $countOfRecords = count($results);
    $numOfPage = ceil($countOfRecords / $limit);

    if ($searchCondition) $searchCondition($offset, $numOfPage, $search);


    if ($countOfRecords === 0) {
      return (object)[
        "status" => false,
        "message" => "No results found for the given search criteria.",
        "pages" => [],
        "numOfPage" => 0,
        "limit" => $limit
      ];
    }


    // Lapozott eredmények kiválasztása a limit és offset alapján
    $pagedResults = array_slice($results, $calculated, $limit);
    if (empty($pagedResults)) {
      return (object)[
        "status" => false,
        "message" => "No paginated results found for the given offset and limit.",
        "pages" => [],
        "numOfPage" => 0,
        "limit" => $limit
      ];
    }


    return (object)[
      "status" => true,
      "pages" => $pagedResults,
      "numOfPage" => $numOfPage,
      "limit" => $limit
    ];
  }


  public function show($table, $id)
  {
    try {
      $stmt = $this->Pdo->prepare("SELECT * FROM `$table` WHERE id = :id");
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_OBJ);
      return $result;
    } catch (PDOException $e) {
      Log::error('app', "Internal Server Error", $e->getMessage() . "\n" . $e->getTraceAsString());
      throw new Exception("An error occurred during the database operation in show method: " . $e->getMessage());
    }
  }




  public function all($table)
  {
    try {
      $stmt = $this->Pdo->prepare("SELECT * FROM `$table`");
      $stmt->execute();
      $results = $stmt->fetchAll(PDO::FETCH_OBJ);

      return $results;
    } catch (PDOException  $e) {
      Log::error("Internal Server Error", $e->getMessage() . "\n" . $e->getTraceAsString());
      throw new Exception("An error occurred during the database operation in the all method: " . $e->getMessage());
    }
  }


  public function selectByRecord($table, $column, $value, $param)
  {
    try {
      $stmt = $this->Pdo->prepare("SELECT * FROM {$table} WHERE {$column} = :value");
      $stmt->bindParam(':value', $value, $param);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_OBJ);

      return $result;
    } catch (PDOException $e) {
      Log::error('app', "Internal Server Error", $e->getMessage() . "\n" . $e->getTraceAsString());
      throw new Exception("An error occurred during the database operation in the selectByRecord method: " . $e->getMessage());
    }
  }

  public function selectAllByRecord($table, $entity, $value, $param)
  {
    try {
      $stmt = $this->Pdo->prepare("SELECT * FROM $table WHERE  $entity = :entity");
      $stmt->bindParam(':entity', $value, $param);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_OBJ);
      return $result;
    } catch (PDOException $e) {
      Log::error('app', "Internal Server Error", $e->getMessage() . "\n" . $e->getTraceAsString());
      throw new Exception("An error occurred during the database operation in the selectAllByRecord method: " . $e->getMessage());
    }
  }


  public function deleteRecordById($table, $id)
  {
    try {
      $stmt = $this->Pdo->prepare("DELETE FROM `$table` WHERE `id` = :id");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->execute();
    } catch (PDOException $e) {
      Log::error('app', "Internal Server Error", $e->getMessage() . "\n" . $e->getTraceAsString());
      throw new Exception("An error occurred during the database operation in the deleteRecordById method: " . $e->getMessage());
    }
  }
}

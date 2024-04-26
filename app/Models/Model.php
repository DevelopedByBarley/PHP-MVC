<?php

namespace App\Models;

use App\Helpers\Debug;
use App\Helpers\FileSaver;
use App\Helpers\Mailer;
use PDO;
use PDOException;

class Model
{
  protected $Pdo;
  protected $Debug;
  protected $Mailer;
  protected $FileSaver;


  public function __construct()
  {
    DATABASE_PERM === 1 ? $this->Pdo = getConnect() : null;
    $this->Debug = new Debug();
    $this->Mailer = new Mailer();
    $this->FileSaver = new FileSaver();
  }

  public function sendMail() {
    $name = 'name';
    $this->Mailer->renderAndSend('Test', ['name' => $name], 'arpadsz@max.hu', 'Test');
  }


  public function show($table, $id)
  {
    try {
      $stmt = $this->Pdo->prepare("SELECT * FROM `$table` WHERE id = :id");
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result;
    } catch (PDOException $e) {

      echo "An error occurred during the database operation:: " . $e->getMessage();
      return false;
    }
  }


  public function all($table)
  {
    try {
      $stmt = $this->Pdo->prepare("SELECT * FROM `$table`");
      $stmt->execute();
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return $results;
    } catch (PDOException  $e) {

      echo "An error occurred during the database operation:" . $e->getMessage();
      return false;
    }
  }

  public function selectByRecord($table, $entity, $value, $param)
  {
    $stmt = $this->Pdo->prepare("SELECT * FROM `$table` WHERE $entity = :entity");
    $stmt->bindParam(':entity', $value, $param);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
  }

  public function insert() {

  }

  public function join() {
    
  }
}

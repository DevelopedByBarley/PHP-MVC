<?php

namespace App\Models;

use PDO;
use PDOException;
use Exception;

class Feedback extends Admin
{

    public function store($body, $ip)
    {
     
        $feedback = empty($body) ? 0 :  filter_var($body["feedback"] ?? '', FILTER_VALIDATE_INT);
        
        try {
            $stmt = $this->Pdo->prepare("INSERT INTO `feedbacks` (`id`, `user_ip`, `feedback`, `created_at`) VALUES (NULL, :user_ip, :feedback, current_timestamp());");
            $stmt->bindParam(":user_ip", $ip);
            $stmt->bindParam(":feedback", $feedback);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("An error occurred during the database operation in the store method at Feedback model" . $e->getMessage());
        }
    }
}

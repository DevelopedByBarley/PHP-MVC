<?php

namespace App\Controllers;

use App\Models\Feedback;
use Exception;
use PDO;

class FeedbackController extends Controller
{
    private $Feedback;

    public function __construct()
    {
        parent::__construct();
        $this->Feedback = new Feedback();
    }


    public function feedback()
    {
        try {
            $ip = $this->getIpByUser();
            $isExist = $this->Model->selectByRecord('feedbacks', 'user_ip', $ip, PDO::PARAM_STR);

            echo json_encode(
                ['isExist' => $isExist]
            );
        } catch (Exception $e) {
            http_response_code(500);
            echo "Internal Server Error" . $e->getMessage();
            exit;
        }
    }


    public function storeFeedback()
    {

        try {
            $body = $_POST;
            $ip = $this->getIpByUser();

            $this->Feedback->store($body, $ip);
            $prev = $_SERVER['HTTP_REFERER'];

            header("Location: $prev");
        } catch (Exception $e) {
            http_response_code(500);
            echo "Internal Server Error" . $e->getMessage();
            exit;
        }
    }
}

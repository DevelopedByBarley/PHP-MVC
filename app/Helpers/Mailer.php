<?php

namespace App\Helpers;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
    public function send($address, $body, $subject)
    {

        try {
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPDebug = 3;
            $mail->setFrom($_SERVER['MAILER_SET_FROM'], $_SERVER['MAILER_SET_TO']);
            $mail->addAddress($address);
            $mail->Username = $_SERVER['MAILER_USERNAME'];
            $mail->Password = $_SERVER['MAILER_PASSWORD'];
            $mail->Host = $_SERVER['MAILER_HOST'];
            $mail->CharSet = 'UTF-8';
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ];
            $mail->isHTML(true);
            return $mail->send();
        } catch (Exception $e) {
            var_dump($e);
            return false;
        }
    }
}

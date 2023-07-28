<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MyMailer
{
    private $mail;
    private $data;
    public function __construct()
    {
        $this->data = [];
        $this->mail = new PHPMailer(true);
    }
    public function sendMail($to, $subject, $content)
    {
        try {
            //Server settings
            $this->mail->SMTPDebug = SMTP::DEBUG_OFF;
            $this->mail->isSMTP();
            $this->mail->Host       = 'smtp.gmail.com';
            $this->mail->SMTPAuth   = true;
            $this->mail->Username   = _SENDER_EMAIL_ADDRESS;
            $this->mail->Password   = _PASS_EMAIL_ADDRESS;
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $this->mail->Port       = 465;
            $this->mail->CharSet = 'UTF-8';
            $this->mail->setFrom(_SENDER_EMAIL_ADDRESS, _SENDER_NAME);
            $this->mail->addAddress($to);
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body    = $content;
            return $this->mail->send();
        } catch (Exception $e) {
            $this->data['message'] = $this->mail->ErrorInfo;
            App::getApp()->renderError('service', $this->data);
        }
    }
}

<?php

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'Interfaces/IMail.php';

class Mail implements IMail{

    private $mail;
    public function __construct()
    {
        $this->mail = new PHPMailer\PHPMailer\PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->SMTPDebug = 2;
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'email@gmail.com';
        $this->mail->password = 'email password';
        $this->mail->SMTPSecure = 'ssl';
        $this->mail->Port = 465;
    }

    public function setRecipients($subject, $body, $alt_body, $recipient_address, $recipient_name = '')
    {
        $this->mail->setFrom($this->mail->Username, 'Tak-Ang Restaurant');
        $this->mail->addAddress($recipient_address, $recipient_name);
        $this->mail->isHTML();
        $this->mail->Subject = $subject;
        $this->mail->Body = $body;
        $this->mail->AltBody = $alt_body;

    }

    public function send() {
        try {
            $this->mail->send();
            return true;
        } catch (Exception  $er) {
            return $this->mail->ErrorInfo;
        }
    }
}
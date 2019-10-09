<?php

require_once 'vendor/phpmailer/phpmailer/src/Exception.php';
require_once 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once 'vendor/phpmailer/phpmailer/src/SMTP.php';
require_once 'Interfaces/IMail.php';

class Mail implements IMail{

    private $mail;
    public function __construct()
    {
        $this->mail = new PHPMailer\PHPMailer\PHPMailer();
        // $this->mail->SMTPDebug = 3;
        $this->mail->isSMTP();   
        $this->mail->Host = "smtp.gmail.com";
        $this->mail->SMTPAuth = true;
        //dummy
        $this->mail->Username = "takang.restaurant@gmail.com";                 
        $this->mail->Password = "takang123";
        $this->mail->SMTPSecure = "tls";
        $this->mail->Port = 587; 
    }

    public function setRecipients($subject, $body, $recipient_address, $recipient_name = '')
    {
        $this->mail->setFrom($this->mail->Username, 'Tak-Ang Restaurant');
        $this->mail->addAddress($recipient_address, $recipient_name);
        $this->mail->Subject = $subject;
        $this->mail->Body = $body;
        $this->mail->isHTML(true);
    }

    public function send() {
        try {
            if ($this->mail->send())
                return true;
            else
                return false;
        } catch (Exception  $er) {
            return $this->mail->ErrorInfo;
        }
    }
}
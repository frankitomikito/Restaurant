<?php

require 'http/Mail/Mail.php';

$mail = new Mail;

$mail->setRecipients('Account Confirmation', 'Hello test', 'Hello test', 'moralde.sama@gmail.com');
echo $mail->send();


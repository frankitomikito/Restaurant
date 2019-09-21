<?php

// require 'http/Mail/Mail.php';

// $mail = new Mail;

// $mail->setRecipients('Account Confirmation', 'Hello test', 'Hello test', 'moralde.sama@gmail.com');
// echo $mail->send();

$date =date_format(
    date_add(date_create(),
    date_interval_create_from_date_string('5 Days')
), 'Y-m-d H:s:i');
echo $date;
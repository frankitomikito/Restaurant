<?php

interface IMail {
    public function send();
    public function setRecipients($subject, $body, $alt_body, $recipient_address, $recipient_name = '');
}
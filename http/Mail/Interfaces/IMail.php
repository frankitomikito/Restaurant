<?php

interface IMail {
    public function send();
    public function setRecipients($subject, $body, $recipient_address, $recipient_name = '');
}
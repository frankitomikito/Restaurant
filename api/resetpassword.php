<?php 

require_once('../http/RequestRoute.php');
require_once('../http/Response.php');
require_once('../Models/User.php');
require_once('../Models/UserCode.php');
require_once('../http/Mail/Mail.php');

RequestRoute::POST(function() {
    $email = RequestRoute::PARAMPOST('email');
    $user = new User;
    $user_code = new UserCode;
    $mail = new Mail;
    
    $user = $user->search(['search' => 'userid_email', 'value' => $email]);
    $code_generated = $user_code->create(['user_id' => $user->user_id]);

    $mail->setRecipients('Reset Password', 
		'Hello '.$user->fullname.', please click this
		<a href="http://localhost:8000/reset-password.php?code='.$code_generated.'">link</a> to reset your password.',
        $user->email);
    if($mail->send())
        return new Response(['data' => 'Success'], 201);
    else 
        return new Response(['data' => 'Something went wrong.'], 200);

});

RequestRoute::PUT(function() {
    $password = RequestRoute::PARAMPUT('password');
    $user_id = RequestRoute::PARAMPUT('user_id');
    $code_id = RequestRoute::PARAMPUT('code_id');
    $user = new User;
    $user_code = new UserCode;
    if($user_code->update($code_id)) {
        $result = $user->updatePassword(password_hash($password, PASSWORD_DEFAULT), $user_id);
        if($result['status'])
            return new Response(['data' => 'Success'], 200);
        else
            return new Response(['data' => 'Something went wrong'], 200);
    }
    else
        return new Response(['data' => 'Something went wrong'], 200);
});
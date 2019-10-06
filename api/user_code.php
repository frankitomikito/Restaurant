<?php 

require_once('../http/RequestRoute.php');
require_once('../http/Response.php');
require_once('../Models/User.php');
require_once('../Models/UserCode.php');

RequestRoute::PUT(function() {
    $user = new User;
    $get_user = $user->get(RequestRoute::PARAMPUT('user_id'));
    $get_user['username'] = RequestRoute::PARAMPUT('username');
    $get_user['password'] = password_hash(RequestRoute::PARAMPUT('password'), PASSWORD_DEFAULT);
    $is_success = $user->update_credentials($get_user);
    if ($is_success) {
        $user_code = new UserCode;
        $is_success = $user_code->update(RequestRoute::PARAMPUT('code_id'));
        if ($is_success)
            return new Response(['status' => true], 200);
        else
            return new Response(['error' => 'Failed updating on user'], 400);
    }
    else 
        return new Response(['error' => 'Failed updating on user'], 400);
});
<?php

require_once($_SERVER["DOCUMENT_ROOT"].'/Models/User.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/http/RequestRoute.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/http/Response.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Models/ImageUploader.php');

RequestRoute::POST(function() {
    $image = RequestRoute::PARAMFILE('user_image') ? 
        ImageUploader::uploadImage(RequestRoute::PARAMFILE('user_image')) :
        RequestRoute::PARAMPOST('image_path');
    $data = [
        'user_id' => RequestRoute::PARAMPOST('user_id'),
        'fullname' => RequestRoute::PARAMPOST('fullname'),
        'email' => RequestRoute::PARAMPOST('email'),
        'address' => RequestRoute::PARAMPOST('address'),
        'position' => (int)RequestRoute::PARAMPOST('position'),
        'gender' => (int)RequestRoute::PARAMPOST('gender'),
        'image_path' => $image,
        'status' => (int)RequestRoute::PARAMPOST('status')
    ];

    $user = new User;
    $result = $user->update($data);
    if ($result)
        return new Response(['value' => true], 200);
    else
        return new Response(['error' => 'Something went wrong'], 404);
});
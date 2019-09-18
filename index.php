<?php

$request = $_SERVER['REQUEST_URI'];
switch ($request) {
    case '/' :
        require 'views/landingpage.php';
        break;
    case '/about' :
        require 'views/404.php';
        break;
    case '/apis/user':
    	require 'api/user.php';
        break;
        case '/login':
        require 'views/login.php';
        break;
    default:
        require 'views/404.php';
        break;
}
<?php

$request = $_SERVER['REQUEST_URI'];
if (strpos($request, '?') != False)
    $request = substr($request, 0, strpos($request, '?'));

$request = strtolower($request);
switch ($request) {
    case '/' :
        require 'views/landingpage.php';
        break;
    case '/about' :
        require 'views/404.php';
        break;
    case '/apis/user':
    	require 'api/user_save_get.php';
        break;
    case '/apis/user_update':
    	require 'api/user_update.php';
        break;
    case '/apis/user_code':
        require 'api/user_code_update.php';
        break;
    case '/apis/menu':
        require 'api/menu.php';
        break;
    case '/login':
        require 'views/login.php';
        break;
    case '/admin/dashboard': 
        require 'dashboard/index.php';
        break;
    case '/admin/employee':
        require 'views/admin/employee.php';
        break;
    case '/account/confirmation':
        require 'views/admin/account-confirmation.php';
        break;
    case '/forgot':
        require 'views/forgot.php';
        break;
    case '/forgot/submit':
        require 'views/reset-password.php';
        break;
    case '/email':
        require 'views/admin/email.php';
        break;
    case '../dashboard/booking-list':
        require 'dashboard/booking-list.php';
        break;
    default:
        require 'views/404.php';
        break;
}
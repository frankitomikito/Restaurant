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
    case '/apis/reservation':
        require 'api/reservation.php';
        break;
    case '/apis/order':
        require 'api/order.php';
        break;
    case '/login':
        require 'views/login.php';
        break;
    case '/customer/reservation':
        require 'views/customer/reservation.php';
        break;
    case '/admin/dashboard': 
        require 'dashboard/index.php';
        break;
    case '/admin/employee':
        require 'views/admin/employee.php';
        break;
    case '/customer/orders':
        require 'views/customer/orders.php';
        break;
    case '/account/confirmation':
        require 'views/admin/account-confirmation.php';
        break;
    case '/customer/confirmation':
        require 'views/customer/email-confirmation.php';
        break;
    case '/cashier/dashboard':
        require 'views/cashier/dashboard.php';
        break;
    case '/cashier/booking':
        require 'views/cashier/booking.php';
        break;
    case '/cashier/payment':
        require 'views/cashier/payment.php';
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
    case '/logout':
        require 'logout.php';
        break;
    case '../dashboard/booking-list':
        require 'dashboard/booking-list.php';
        break;
    default:
        require 'views/404.php';
        break;
}
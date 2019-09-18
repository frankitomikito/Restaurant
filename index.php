<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/' :
        require 'views/landingpage.php';
        break;
    case '/about' :
        require __DIR__ . '/views/about.php';
        break;
    default:
        require 'views/404.php';
        break;
}
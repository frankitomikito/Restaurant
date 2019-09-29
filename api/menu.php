<?php 

require_once('http/RequestRoute.php');
require_once('http/Response.php');
require_once('Models/Menu.php');

RequestRoute::GET(function() {
    $menu = new Menu;
    return new Response($menu->getAll(), 200);
});
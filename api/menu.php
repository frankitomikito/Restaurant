<?php 

require_once($_SERVER['DOCUMENT_ROOT'].'\http\RequestRoute.php');
require_once($_SERVER['DOCUMENT_ROOT'].'\http\Response.php');
require_once($_SERVER['DOCUMENT_ROOT'].'\Models\Menu.php');

RequestRoute::GET(function() {
    $menu = new Menu;
    return new Response($menu->getAll(), 200);
});
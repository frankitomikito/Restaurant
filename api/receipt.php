<?php 

require_once('http/RequestRoute.php');
require_once('http/Response.php');
require_once('Models/Receipt.php');

RequestRoute::GET(function() {
    $receipt = new Receipt;
    if(RequestRoute::PARAMGET('datatable'))
        return new Response(['data' => $receipt->getAll()], 200);
});
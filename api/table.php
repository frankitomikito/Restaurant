<?php 

require_once($_SERVER['DOCUMENT_ROOT'].'/http/RequestRoute.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/http/Response.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Models/Table.php');

RequestRoute::GET(function() {
    $table = new Table;
    if(RequestRoute::PARAMGET('datatable')) {
        $response = ['data' => $table->getAll()];
        return new Response($response, 200);
    }
    else {
        $response = ['data' => $table->getReceiptStatus()];
        return new Response($response, 200);
    }
});
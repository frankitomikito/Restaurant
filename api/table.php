<?php 

require_once('../http/RequestRoute.php');
require_once('../http/Response.php');
require_once('../Models/Table.php');

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
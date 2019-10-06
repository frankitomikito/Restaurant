<?php 

require_once('http/RequestRoute.php');
require_once('http/Response.php');
require_once('Models/Receipt.php');
require_once('Models/Reservation.php');

RequestRoute::GET(function() {
    $receipt = new Receipt;
    if(RequestRoute::PARAMGET('datatable'))
        return new Response(['data' => $receipt->getAll()], 200);
});

RequestRoute::PUT(function() {
    $order_id = RequestRoute::PARAMPUT('order_id');
    $booking_id = RequestRoute::PARAMPUT('booking_id');
    $receipt = new Receipt;
    $reservation = new Reservation;
    $param = ['update' => 'payment', 'value' => $order_id];
    if ($receipt->update($param)) {
        if($reservation->update(['update' => 'used', 'value' => $booking_id])) {
            return new Response(['data' => 'Success'], 200);
        } 
        else
            return new Response(['data' => 'Something Went Wrong.'], 200);
    } 
    else
        return new Response(['data' => 'Something Went Wrong.'], 200);
});
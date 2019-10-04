<?php
session_start();

require_once('http/RequestRoute.php');
require_once('http/Response.php');
require_once('Models/Reservation.php');

RequestRoute::GET(function() {
    $reservation = new Reservation;
    if (RequestRoute::PARAMGET('datatable')) {
        $result = $reservation->rawQuery('SELECT tbt.booking_id, tbt.check_in, tt.table_name, tt.capacity, tbt.status 
        FROM tbl_booking AS tbt INNER JOIN tbl_booked_table AS tb ON tb.booking_id = tbt.booking_id
        INNER JOIN tbl_table AS tt ON tt.table_id = tb.table_id
        WHERE tbt.user_id = '.$_SESSION['id']);
        $response = ['data'=> $reservation->convertResultToJson($result)];
        return new Response($response, 200);
    }
    else
        return new Response($reservation->getAll(), 200);
});

RequestRoute::PUT(function() {
    $response = [
        'data' => RequestRoute::PARAMPUT('booking_id'),
        'test' => 'rest'
    ];
    return new Response($response, 200);
});
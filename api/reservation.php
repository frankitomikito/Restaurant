<?php

session_start();

require_once('../http/RequestRoute.php');
require_once('../http/Response.php');
require_once('../Models/Reservation.php');

RequestRoute::GET(function() {
    $reservation = new Reservation;
    if (RequestRoute::PARAMGET('datatable')) {        
        $response = ['data'=> $reservation->bookingList()];
        return new Response($response, 200);
    }
    elseif (RequestRoute::PARAMGET('cashier')) {
        $response = ['data'=> $reservation->getAll()];
        return new Response($response, 200);
    } 
    else
        return new Response($reservation->customerReservations(), 200);
});

RequestRoute::POST(function() {
    $reservation = new Reservation;
    if (RequestRoute::PARAMGET('update')) {
        $booking_id = RequestRoute::PARAMPOST('booking_id');
        $param = ['update' => 'confirmed', 'value' => $booking_id];
        $result = $reservation->update($param);
        if ($result)
            return new Response(['data' => 'Success'], 200);
        else 
            return new Response(['error' => 'Something went wrong. Try again'], 200);
    } 
    elseif (RequestRoute::PARAMGET('cancel')) {
        $booking_id = RequestRoute::PARAMPOST('booking_id');
        $reservation = new Reservation;
        $result = $reservation->remove($booking_id);
        if ($result)
            return new Response(['data' => 'Success'], 200);
        else 
            return new Response(['error' => 'Something went wrong. Try again'], 200);
    }
});
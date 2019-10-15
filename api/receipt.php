<?php 
session_start();

require_once('../http/RequestRoute.php');
require_once('../http/Response.php');
require_once('../Models/Receipt.php');
require_once('../Models/Reservation.php');

RequestRoute::GET(function() {
    $receipt = new Receipt;
    if(RequestRoute::PARAMGET('datatable'))
        return new Response(['data' => $receipt->getAll()], 200);
    elseif(RequestRoute::PARAMGET('chef'))
        return new Response(['data' => $receipt->getReceiptsChef()], 200);
    elseif(RequestRoute::PARAMGET('date_from') && RequestRoute::PARAMGET('date_to')){
        $date_from = RequestRoute::PARAMGET('date_from');
        $date_to = RequestRoute::PARAMGET('date_to');
        return new Response(['data' => $receipt->getSalesByFromTo($date_from, $date_to)], 200);
    }
    elseif(RequestRoute::PARAMGET('chef_cooked')) 
        return new Response(['data' => $receipt->getChefsOrdersCooked()], 200);
    else {
        return new Response(['data' => 'Invalid Request'], 404);
    }
});

RequestRoute::POST(function() {
    $receipt = new Receipt;
    $order_id = RequestRoute::PARAMPOST('order_id');
    if (RequestRoute::PARAMGET('payment')) {
        $booking_id = RequestRoute::PARAMPOST('booking_id');
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
    }
    elseif(RequestRoute::PARAMGET('is_serve')) {
        $param = ['update' => 'ready', 'value' => $order_id];
        if ($receipt->update($param)) {
        return new Response(['data' => 'Success'], 200);
        }
        else
            return new Response(['data' => 'Something Went Wrong.'], 200);
    }
    else {
        $param = ['update' => 'process', 'value' => $order_id];
        if ($receipt->update($param)) {
        return new Response(['data' => 'Success'], 200);
        }
        else
            return new Response(['data' => 'Something Went Wrong.'], 200);
    }
});
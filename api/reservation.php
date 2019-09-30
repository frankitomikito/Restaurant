<?php
session_start();

require_once('http/RequestRoute.php');
require_once('http/Response.php');
require_once('Models/Reservation.php');

RequestRoute::GET(function() {
    $reservation = new Reservation;
    return new Response($reservation->getAll(), 200);
});
<?php
session_start();

require_once('http/RequestRoute.php');
require_once('http/Response.php');
require_once('Models/Receipt.php');
require_once('Models/Order.php');

RequestRoute::GET(function() {
    $receipt = new Receipt;
    $order = new Order;

    if (!empty(RequestRoute::PARAMGET('month'))) {
        return new Response($receipt->search(RequestRoute::PARAMGET('month')), 200);
    }
    else if(!empty(RequestRoute::PARAMGET('date'))) {
        $param = [
            "search" => 'todaysales',
            "value" => RequestRoute::PARAMGET('date')
        ];
        return new Response($order->search($param), 200);
    }
    else if(!empty(RequestRoute::PARAMGET('tableId'))) {
        $table_id = RequestRoute::PARAMGET('tableId');
        return new Response($order->getOrdersByTableId($table_id), 200);
    }
    else {
        $response = [
            "orders" => $order->getAll(),
            "receipt" => $receipt->get($_SESSION['id']),
        ];
        return new Response($response, 200);
    }
});

RequestRoute::POST(function() {
    $datetime = date_format(date_create(), 'Y-m-d H:s:i');
    $receipt_data = json_decode(RequestRoute::PARAMPOST('receipt'));
    $receipt_value = [
        "total" => $receipt_data->total,
        "discount" => 0,
        "table_id" => $receipt_data->table_id,
        "user_id" => $_SESSION['id'],
        "date_ordered" => $datetime
    ];
    $receipt = new Receipt;
    $result = $receipt->create($receipt_value);
    if ($result) {
        $orders = json_decode(RequestRoute::PARAMPOST('orders'));
        $order = new Order;
        try {
            foreach ($orders as $key => $value) {
                $data = [
                    "quantity" => $value->quantity,
                    "menu_id" => $value->menu_id,
                    "order_id" => $result['order_id']
                ];
                $order->create($data);
            }
            return new Response("Success", 201);
        } catch (\Throwable $th) {
            return new Response("Something went wrong.", 400);
        }
    } else {
        return new Response("Something went wrong.", 400);
    }
});
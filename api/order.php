<?php
session_start();

require_once('../http/RequestRoute.php');
require_once('../http/Response.php');
require_once('../Models/Receipt.php');
require_once('../Models/Order.php');

RequestRoute::GET(function() {
    $receipt = new Receipt;
    $order = new Order;

    if (!empty(RequestRoute::PARAMGET('month'))) {
        $param = [
            "search" => 'receipt_month',
            "value" => RequestRoute::PARAMGET('month')
        ];
        return new Response($receipt->search($param), 200);
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
        $response = [
            'orders' => $order->getOrdersByTableId($table_id),
            'customer_info' => $receipt->getCustomerDetailsByTableId($table_id)
        ];
        return new Response($response, 200);
    }
    else if(!empty(RequestRoute::PARAMGET('receipt_id'))) {
        $receipt_id = RequestRoute::PARAMGET('receipt_id');
        return new Response($order->get($receipt_id), 200);
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
        'total' => $receipt_data->total,
        'discount' => 0,
        'table_id' => $receipt_data->table_id,
        'user_id' => $_SESSION['id'],
        'date_ordered' => $datetime
    ];
    $orders = json_decode(RequestRoute::PARAMPOST('orders'));
    $receipt = new Receipt;
    $param = [
        'search' => 'receipt_status'
    ];
    $search_result = $receipt->search($param);
    if ($search_result->num_rows > 0) {
        return saveOrders($orders, $search_result, true);
    }
    else {
        $result = $receipt->create($receipt_value);
        if ($result) {
            return saveOrders($orders, $result, false);
        } else {
            return new Response("Something went wrong.", 400);
        }
    }
});

function saveOrders($orders, $result, $has_orders) {
    try {
        $order = new Order;
        if ($has_orders) {
            $results = $result->fetch_all();
            $order_id = $results[0][0];
            foreach ($orders as $key => $value) {
                $is_exist = false;
                foreach ($results as $key2 => $value2) {
                    if ($value->menu_id == $value2[2]) {
                        $data = [
                            "quantity" => $value->quantity + $value2[3],
                            "order_item_id" => $value2[1]
                        ];
                        $order->update($data);
                        $is_exist = true;
                        unset($results[$key2]);
                    }
                }

                if (!$is_exist) {
                    $data = [
                        "quantity" => $value->quantity,
                        "menu_id" => $value->menu_id,
                        "order_id" => $order_id
                    ];
                    $order->create($data);
                }
            }
            $receipt = new Receipt;
            $param = [
                'update' => 'price',
                'value' => $order_id
            ];
            $receipt->update($param);
        }
        else {
            foreach ($orders as $key => $value) {
                $data = [
                    "quantity" => $value->quantity,
                    "menu_id" => $value->menu_id,
                    "order_id" => $result['order_id']
                ];
                $order->create($data);
            }
        }
        return new Response("Success", 201);
    } catch (\Throwable $th) {
        return new Response("Something went wrong.", 400);
    }
}
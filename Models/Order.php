<?php

require_once('Database.php');
require_once('Interfaces/IActions.php');
require_once('http/RequestRoute.php');

class Order extends Database implements IActions {
    public function get($id){

    }

	public function getAll() {
        $result = $this->rawQuery('SELECT tm.*, tor.quantity, tr.table_id, tor.order_id FROM tbl_user AS tu 
        INNER JOIN tbl_receipt AS tr ON tr.user_id = tu.user_id 
        INNER JOIN tbl_order AS tor ON tor.order_id = tr.order_id
        INNER JOIN tbl_menu AS tm ON tm.menu_id = tor.menu_id
        WHERE tu.user_id = '.$_SESSION['id']);
        return $this->convertResultToJson($result);
    }

	public function create($args){
        try {
            $this->rawQuery('insert into tbl_order (quantity, menu_id, order_id) values 
            ('.$args['quantity'].', '.$args['menu_id'].', '.$args['order_id'].')');
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

	public function update($args){

    }

	public function remove($id){

    }

	public function search($args){
        if($args['search'] == 'todaysales') {
            $result = $this->rawQuery('SELECT tm.name, SUM(tor.quantity * tm.price) AS total  FROM tbl_menu AS tm
            INNER JOIN tbl_receipt AS tr ON DATE(tr.date_ordered) = "'.$args['value'].'" AND tr.status = 0
            INNER JOIN tbl_order AS tor ON tor.menu_id = tm.menu_id AND tor.order_id = tr.order_id 
            GROUP BY tm.name');
            return $this->convertResultToJson($result);
        }
    }

    public function getOrdersByTableId($table_id) {
        $result = $this->rawQuery('SELECT tr.order_id, tm.name, tor.quantity, tm.price FROM tbl_booking AS tb
        INNER JOIN tbl_booked_table AS tbt ON tbt.booking_id = tb.booking_id
        INNER JOIN tbl_receipt AS tr ON tr.user_id = tb.user_id AND tr.status != 0  AND tr.table_id = '.$table_id.'
        INNER JOIN tbl_order AS tor ON tor.order_id = tr.order_id
        INNER JOIN tbl_menu AS tm ON tm.menu_id = tor.menu_id
        WHERE tb.status = 1');
        return $this->convertResultToJson($result);
    }

}
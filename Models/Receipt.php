<?php

require_once('Database.php');
require_once('Interfaces/IActions.php');

class Receipt extends Database implements IActions {
    public function get($id){
        $result = $this->rawQuery('SELECT tr.order_id, tr.date_ordered, tr.total, tr.discount, tb.table_name, tr.status FROM tbl_receipt AS tr
        INNER JOIN tbl_table AS tb ON tb.table_id = tr.table_id
        WHERE user_id = '.$id);
        return $this->convertResultToDatatableArray($result);
    }

	public function getAll(){
        $result = $this->rawQuery('SELECT tr.order_id, tu.fullname, tr.date_ordered, tr.total, tr.discount, tb.table_name, tr.status FROM tbl_receipt AS tr
        INNER JOIN tbl_user AS tu ON tu.user_id = tr.user_id
        INNER JOIN tbl_table AS tb ON tb.table_id = tr.table_id');
        return $this->convertResultToDatatableArray($result);
    }

	public function create($args){
        try {
            $this->rawQuery('insert into tbl_receipt (date_ordered, total, discount, user_id, table_id, status) 
            values ("'.$args['date_ordered'].'", '.$args['total'].', '.$args['discount'].', 
            '.$args['user_id'].', '.$args['table_id'].', 1)');
            $result = $this->rawQuery('select max(order_id) as order_id from tbl_receipt where user_id = '.$args['user_id']);
            return $result->fetch_assoc();
        } catch (\Throwable $th) {
            return false;
        }
    }

	public function update($args){
        switch ($args['update']) {
            case 'payment':
                try {
                    $this->rawQuery('update tbl_receipt set status = 0 where order_id = '.$args['value']);
                    return true;
                } catch (\Throwable $th) {
                    return false;
                }
            case 'process':
                try {
                    $this->rawQuery('update tbl_receipt set status = 2, chef_id = 
                    '.$_SESSION['id'].' where order_id = '.$args['value']);
                    return true;
                } catch (\Throwable $th) {
                    return false;
                }
            case 'ready':
               try {
                    $this->rawQuery('update tbl_receipt set status = 3 where order_id = '.$args['value']);
                    return true;
                } catch (\Throwable $th) {
                    return false;
                }
            case 'price':
                $result = $this->rawQuery('SELECT SUM(tor.quantity * tm.price) AS total FROM tbl_receipt AS tr
                INNER JOIN tbl_order AS tor ON tor.order_id = tr.order_id
                INNER JOIN tbl_menu AS tm ON tm.menu_id = tor.menu_id
                WHERE tr.order_id = '.$args['value'])->fetch_assoc();
                $this->rawQuery('UPDATE tbl_receipt SET total = '.$result['total'].'
                 WHERE order_id = '.$args['value']);
                return true;
            default:
                return false;
        }
    }

	public function remove($id){

    }

	public function search($args){
        switch ($args['search']) {
            case 'receipt_status':
                $result = $this->rawQuery('SELECT tr.order_id, tor.order_item_id, tor.menu_id, tor.quantity FROM tbl_receipt AS tr
                INNER JOIN tbl_order AS tor ON tor.order_id = tr.order_id
                WHERE tr.status = 1 AND tr.user_id = '.$_SESSION['id']);
                return $result;
            
            case 'receipt_month':
                $result = $this->rawQuery('SELECT tr.date_ordered, tr.total, tr.discount FROM tbl_receipt AS tr 
                INNER JOIN tbl_table AS tb ON tb.table_id = tr.table_id WHERE MONTHNAME(tr.date_ordered) = "'.$args['value'].'" 
                AND tr.status = 0');
                return $this->convertResultToJson($result);
        }
    }

    public function getReceiptsChef() {
        $result = $this->rawQuery('SELECT tbl.table_id, tbl.table_name, tr.status FROM tbl_receipt AS tr
        INNER JOIN tbl_table AS tbl ON tbl.table_id = tr.table_id
        WHERE tr.status = 1 or tr.status = 2');
        return $this->convertResultToDatatableArray($result);
    }

    public function getSalesByFromTo($date_from, $date_to) {
        $result = $this->rawQuery('SELECT tr.date_ordered, SUM(tor.quantity * tm.price) AS total  FROM tbl_menu AS tm
        INNER JOIN tbl_receipt AS tr ON DATE(tr.date_ordered) BETWEEN "'.$date_from.'" AND "'.$date_to.'" AND tr.status = 0
        INNER JOIN tbl_order AS tor ON tor.menu_id = tm.menu_id AND tor.order_id = tr.order_id 
        GROUP BY DATE(tr.date_ordered)');
        return $this->convertResultToJson($result);
    }

    public function getChefsOrdersCooked() {
        $result = $this->rawQuery('SELECT tr.order_id, tr.date_ordered, tu.fullname, 
        tbl.table_name, tr.status, tu.image_path FROM tbl_receipt AS tr 
        INNER JOIN tbl_user AS tu ON tu.user_id = tr.chef_id
        INNER JOIN tbl_table AS tbl ON tbl.table_id = tr.table_id');
        return $this->convertResultToDatatableArray($result);
    }

    public function getCustomerDetailsByTableId($table_id) {
        return $this->getUserInfoByColumn($table_id, 'user_id');   
    }
    
    public function getWaiterNameByTableId($table_id) {
        return $this->getUserInfoByColumn($table_id, 'waiter_id');
    }
    
    public function getTabularReportData() {
        $result = $this->rawQuery('SELECT tr.order_id, tu.fullname, tu2.fullname AS waiter, 
        tr.date_ordered, tm.name, tor.quantity, (tor.quantity * tm.price) 
        AS total, tb.table_name, tr.status FROM tbl_receipt AS tr
        INNER JOIN tbl_user AS tu ON tu.user_id = tr.user_id
        INNER JOIN tbl_user AS tu2 ON tu2.user_id = tr.waiter_id
        INNER JOIN tbl_table AS tb ON tb.table_id = tr.table_id
        INNER JOIN tbl_order AS tor ON tor.order_id = tr.order_id
        INNER JOIN tbl_menu AS tm ON tm.menu_id = tor.menu_id');
        if ($result->num_rows > 0)
            return $this->convertResultToDatatableArray($result);
        else
            return [];
    }

    private function getUserInfoByColumn($table_id, $column) {
        $result = $this->rawQuery('SELECT tu.fullname, tu.address, tr.date_ordered FROM tbl_booking AS tb
        INNER JOIN tbl_booked_table AS tbt ON tbt.booking_id = tb.booking_id
        INNER JOIN tbl_receipt AS tr ON tr.user_id = tb.user_id AND tr.status != 0  AND tr.table_id = '.$table_id.'
        INNER JOIN tbl_user AS tu ON tu.user_id = tr.'.$column.'
        WHERE tb.status = 1');
        if ($result->num_rows > 0)
            return $result->fetch_object();
        else
            return null;
    }
}
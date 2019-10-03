<?php

require_once('Database.php');
require_once('Interfaces/IActions.php');
require_once('http/RequestRoute.php');

class Receipt extends Database implements IActions {
    public function get($id){

    }

	public function getAll(){
        $result = $this->rawQuery('SELECT tr.order_id, tr.date_ordered, tr.total, tr.discount, tb.table_name, tr.status FROM tbl_receipt AS tr
        INNER JOIN tbl_table AS tb ON tb.table_id = tr.table_id
        WHERE user_id = '.$_SESSION['id']);
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

    }

	public function remove($id){

    }

	public function search($args){
        $result = $this->rawQuery('SELECT tr.date_ordered, tr.total, tr.discount FROM tbl_receipt AS tr 
        INNER JOIN tbl_table AS tb ON tb.table_id = tr.table_id WHERE MONTHNAME(tr.date_ordered) = "'.$args.'" 
        AND tr.status = 0');
        return $this->convertResultToJson($result);
    }

}
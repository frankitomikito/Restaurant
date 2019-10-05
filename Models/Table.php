<?php

require_once('Database.php');
require_once('Interfaces/IActions.php');
require_once('http/RequestRoute.php');

class Table extends Database implements IActions {
    public function get($id){

    }

	public function getAll() {
        $result = $this->rawQuery('select * from tbl_table');
        $array = Array();
        while($row = $result->fetch_all()) {
			for ($i=0; $i < sizeof($row); $i++) {
				$array[] = $row[$i];
			}
        }
        return $array;
    }

	public function create($args){
        
    }

	public function update($args){

    }

	public function remove($id){

    }

	public function search($args){
        
    }

    public function getReceiptStatus() {
        $result = $this->rawQuery('SELECT tbl.table_id, tb.status FROM tbl_booking AS tb
        INNER JOIN tbl_booked_table AS tbt ON tbt.booking_id = tb.booking_id
        INNER JOIN tbl_table AS tbl ON tbl.table_id = tbt.table_id
        WHERE tb.status = 1');
        return $this->convertResultToJson($result);
    }

}
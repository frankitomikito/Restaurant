<?php

require_once('Database.php');
require_once('Interfaces/IActions.php');
require_once('http/RequestRoute.php');

class Reservation extends Database implements IActions {
    public function get($id){

    }

	public function getAll(){
        $result = $this->rawQuery('SELECT tbt.*, tb.table_id, tt.table_name FROM tbl_booking AS tbt 
        INNER JOIN tbl_booked_table AS tb ON tb.booking_id = tbt.booking_id
        INNER JOIN tbl_table AS tt ON tt.table_id = tb.table_id
        WHERE tbt.user_id = '.$_SESSION['id'].' AND tbt.status = 1');
        return $this->convertResultToJson($result);
    }

	public function create($args){

    }

	public function update($args){

    }

	public function remove($id){

    }

	public function search($args){

    }

}
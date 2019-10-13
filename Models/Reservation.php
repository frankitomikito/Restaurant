<?php

require_once('Database.php');
require_once('Interfaces/IActions.php');
require_once('../http/RequestRoute.php');

class Reservation extends Database implements IActions {
    public function get($id){

    }

	public function getAll(){
        $result = $this->rawQuery('SELECT tbt.booking_id, tbt.check_in, tu.fullname, tt.table_name, tt.capacity, tbt.status 
        FROM tbl_booking AS tbt 
        INNER JOIN tbl_booked_table AS tb ON tb.booking_id = tbt.booking_id
        INNER JOIN tbl_user AS tu ON tu.user_id = tbt.user_id
        INNER JOIN tbl_table AS tt ON tt.table_id = tb.table_id WHERE tbt.status = 0 OR tbt.status = 1');
        return $this->convertResultToDatatableArray($result);
    }

	public function create($args){

    }

	public function update($args){
        switch ($args['update']) {
            case 'used':
                try {
                    $this->rawQuery('update tbl_booking set status = 3 where booking_id = '.$args['value']);
                    return true;
                } catch (\Throwable $th) {
                    return false;
                }
            
            case 'confirmed':
                try {
                    $this->rawQuery('update tbl_booking set status = 1 where booking_id = '.$args['value']);
                    return true;
                } catch (\Throwable $th) {
                    return false;
                }
        }
    }

	public function remove($id){
        try {
            $this->rawQuery('update tbl_booking set status = 4 where booking_id = '.$id);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

	public function search($args){

    }

    public function customerReservations() {
        if(isset($_SESSION['id'])) {
            $result = $this->rawQuery('SELECT tbt.*, tb.table_id, tt.table_name FROM tbl_booking AS tbt 
            INNER JOIN tbl_booked_table AS tb ON tb.booking_id = tbt.booking_id
            INNER JOIN tbl_table AS tt ON tt.table_id = tb.table_id
            WHERE tbt.user_id = '.$_SESSION['id'].' AND tbt.status = 1');
            return $this->convertResultToJson($result);
        } else {
            return [];
        }
    }

    public function bookingList() {
        $result = $this->rawQuery('SELECT tbt.booking_id, tbt.check_in, tt.table_name, tt.capacity, tbt.status 
        FROM tbl_booking AS tbt INNER JOIN tbl_booked_table AS tb ON tb.booking_id = tbt.booking_id
        INNER JOIN tbl_table AS tt ON tt.table_id = tb.table_id
        WHERE tbt.user_id = '.$_SESSION['id']);
        if($result->num_rows > 0) {
            while($row = $result->fetch_all()) {
                for ($i=0; $i < sizeof($row); $i++) {
                    $array[] = $row[$i];
                }
            }
            return $array;
        }
        else 
            return [];
    }

}
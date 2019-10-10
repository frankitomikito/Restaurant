<?php

require_once('Database.php');
require_once('Interfaces/IActions.php');

class Menu extends Database implements IActions {
    public function get($id){

    }

	public function getAll(){
        $result = $this->rawQuery('select * from tbl_menu where status != 0');
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
<?php 

require_once('Database.php');
require_once('Interfaces/IActions.php');

class User extends Database implements IActions {

	public function get($id)
	{
		throw new \Exception('Method get() is not implemented.');
	}

	public function getAll()
	{
		$result = $this->rawQuery('select user_id, email, gender, address, position, image_path, status from tbl_user where user_id != 0');
		return $this->convertResultToJson($result);
	}

	public function create($args)
	{
		throw new \Exception('Method create() is not implemented.');
	}

	public function update($args)
	{
		throw new \Exception('Method update() is not implemented.');
	}

	public function remove($id)
	{
		throw new \Exception('Method remove() is not implemented.');
	}

	public function search($args)
	{
		throw new \Exception('Method search() is not implemented.');
	}

	private function convertResultToJson($result) {
		$array = Array();
		while($row = $result->fetch_object()) {
			$array[] = $row;
		}
		return $array;
	}
}


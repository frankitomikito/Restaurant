<?php 

require_once('Database.php');
require_once('Interfaces/IActions.php');
require_once('http/RequestRoute.php');

class User extends Database implements IActions {

	public function get($id)
	{
		throw new \Exception('Method get() is not implemented.');
	}

	public function getAll()
	{
		$returnType = RequestRoute::PARAMGET('returnType');
		$result = $this->rawQuery('select user_id, fullname, email, gender, address, position, status, image_path from tbl_user where user_id != 1 and user_id != 4 and status != 0');
		switch ($returnType) {
			case 'datatable':
				return $this->convertResultToDatatableValue($result);
				break;
			default:
				return $this->convertResultToJson($result);
				break;
		}
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
}
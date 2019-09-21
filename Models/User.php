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
		$result = $this->rawQuery('select user_id, fullname, email, gender, address, position, status, image_path from tbl_user where user_id != 1 and user_id != 4');
		switch ($returnType) {
			case 'datatable':
				return $this->convertResultToDatatableArray($result);
				break;
			default:
				return $this->convertResultToJson($result);
				break;
		}
	}

	public function create($args)
	{
		try {
			$result = $this->rawQuery('insert into tbl_user (fullname, email, gender, address, position, image_path, status) values ("'.$args['fullname'].'", "'.$args['email'].'", '.$args['gender'].', "'.$args['address'].'", '.$args['position'].', "'.$args['image_path'].'", 1)');
			return ['status' => $result];
		} catch (Exception $e) {
			return ['status' => false, 'error' => $e];
		}
	}

	public function update($args)
	{
		try {
			$this->rawQuery('update tbl_user set 
				fullname = "'.$args['fullname'].'", 
				email = "'.$args['email'].'", 
				address = "'.$args['address'].'",
				gender = '.$args['gender'].', 
				position = '.$args['position'].',
				image_path = "'.$args['image_path'].'",
				status = '.$args['status'].' where user_id = '.$args['user_id']);
			return ['status' => true];
		} catch (Exception $th) {
			return ['status' => false, 'error' => $th];
		}
	}

	public function remove($id)
	{
		throw new \Exception('Method remove() is not implemented.');
	}

	public function search($args)
	{
		switch ($args) {
			case 'user_id':
				try {
					$result = $this->rawQuery('select max(user_id) as user_id from tbl_user')->fetch_object();
					$user = $this->rawQuery('select * from tbl_user where user_id = '.$result->user_id);
					return $user->fetch_object();
				} catch (\Throwable $th) {
					return null;
				}
				break;
			
			default:
				return null;
				break;
		}
	}

	private function convertUsersToDatatableJson($result) {
		$array = Array();
		while($row = $result->fetch_object()) {
			$row->position = User::getPositionText($row->position);
			$row->status = User::getPositionText($row->status);
			$row->gender = User::getGenderText($row->gender);
			$array[] = $row;
		}
		return $array;
	}

	public static function getPositionText($num) {
		switch ($num) {
			case 1:
				return 'Admin';
			case 2:
				return 'Customer';
			case 3:
				return 'Chef';
			case 4:
				return 'Waiter';
		}
	}

	public static function getGenderText($num) {
		switch ($num) {
			case 0:
				return "Female";
			case 1:
				return "Male";
		}
	}
}
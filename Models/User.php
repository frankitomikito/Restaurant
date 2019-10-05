<?php 

require_once('Database.php');
require_once('Interfaces/IActions.php');
require_once('http/RequestRoute.php');

class User extends Database implements IActions {

	public function get($id)
	{
		$result = $this->rawQuery('select * from tbl_user where user_id = '.$id);
		return $result->fetch_assoc();
	}

	public function getAll()
	{
		$returnType = RequestRoute::PARAMGET('returnType');
		$result = $this->rawQuery('select user_id, fullname, email, gender, address, position, status, image_path from tbl_user where position != 1 and position != 2');
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

	public function update_credentials($args) {
		try {
			$this->rawQuery('update tbl_user set username = "'.$args['username'].'", 
			password = "'.$args['password'].'", email = "'.$args['email'].'" where user_id = '.$args['user_id']);
			return true;
		} catch (\Throwable $th) {
			return false;
		}
	}

	public function remove($id)
	{
		throw new \Exception('Method remove() is not implemented.');
	}

	public function search($args)
	{
		switch ($args['search']) {
			case 'user_id':
				try {
					$result = $this->rawQuery('select max(user_id) as user_id from tbl_user')->fetch_object();
					$user = $this->rawQuery('select * from tbl_user where user_id = '.$result->user_id);
					return $user->fetch_object();
				} catch (\Throwable $th) {
					return null;
				}
				break;
			case 'email':
				try {
					$result = $this->rawQuery('select count(email) as isExist from tbl_user where email = 
					"'.$args['value'].'"')->fetch_object();
					if ((bool)$result->isExist) {
						return true;
					} else {
						return false;
					}
				} catch (\Throwable $th) {
					return null;
				}
				break;
			default:
				return null;
				break;
		}
	}

	public function login($args) {
		try {
			$user = null;
			if (strpos($args['useremail'], '@') !== false)
				$user = $this->rawQuery('select * from tbl_user where email = "'.$args['useremail'].'"');
			else
				$user = $this->rawQuery('select * from tbl_user where username = "'.$args['useremail'].'"');
			
			if ($user->num_rows > 0) {
				$user = $user->fetch_assoc();
				if ((bool)password_verify($args['password'], $user['password'])) {
					return $user;
				} else {
					return null;
				}
			} else {
				return null;
			}
		} catch (\Throwable $th) {
			return null;
		}
	}

	public static function getPositionText($num) {
		switch ($num) {
			case 1:
				return 'Administrator';
			case 2:
				return 'Customer';
			case 3:
				return 'Chef';
			case 4:
				return 'Waiter';
			case 5:
				return 'Cashier';
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
}
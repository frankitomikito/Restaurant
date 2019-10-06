<?php

require_once('Database.php');
require_once('Interfaces/IActions.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/http/RequestRoute.php');

class UserCode extends Database implements IActions {
    

	public function get($id)
	{
		throw new \Exception('Method get() is not implemented.');
	}

	public function getAll()
	{
		throw new \Exception('Method getAll() is not implemented.');
	}

	public function create($args)
	{
		try {
            $datetime = date_format(
                date_add(date_create(),
                date_interval_create_from_date_string('5 Days')
            ), 'Y-m-d H:s:i');
            $code_generated = $this->generateCode();
            $this->rawQuery('insert into tbl_user_code (code, code_expiration, user_id, status) values (
                "'.$code_generated.'",
                "'.$datetime.'",
                '.$args['user_id'].',
                1
            )');
            return $code_generated;
        } catch (Exception $th) {
            return false;
        }
	}

	public function update($args)
	{
		try {
            $this->rawQuery('update tbl_user_code set status = 0 where code_id = '.$args);
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
            case 'code':
                $result = $this->rawQuery('select * from tbl_user_code where code = "'.$args['value'].'" and status != 0');
                if ($result->num_rows > 0)
                    return $result->fetch_assoc();
                else 
                    return null;
        }
    }
    
    private function generateCode() {
        $str = '';
        $str_len = 15;
        for ($i = 0; $i < $str_len; $i++) {
            $str .= chr(rand(97, 122)).chr(rand(48, 57));
        }
        return $str;
    }
}
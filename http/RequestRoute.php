<?php 

require_once('Interfaces/IRequestMethod.php');
require_once('Interfaces/IRequestParams.php');
require_once('Response.php');

class RequestRoute extends Response implements IRequestMethod, IRequestParams {


	public static function GET($callback)
	{
		if ($_SERVER["REQUEST_METHOD"] == "GET") {
			$response = $callback();
			echo $response->data;
		}
	}

	public static function POST($callback)
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$response = $callback();
			echo $response->data;
		}
	}

	public static function PUT($callback)
	{
		if ($_SERVER["REQUEST_METHOD"] == "PUT") {
			$response = $callback();
			echo $response->data;
		}
	}

	public static function DELETE($callback)
	{
		if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
			echo $callback();
		}
	}

	public static function PARAMGET($param_name)
	{
		if (isset($_GET[$param_name]))
			return $_GET[$param_name];
		else
			return '';
	}

	public static function PARAMPOST($param_name = false)
	{
		if (!$param_name) {
			$postdata = file_get_contents("php://input");
			$request = json_decode($postdata);
			if (isset($request))
				return $request;
			else
				return '';
		} else {

			if (isset($_POST[$param_name]))
				return $_POST[$param_name];
			else
				return '';
		}
	}
	
	public static function PARAMPUT($param_name) {
		//wa ko kasabot gi unsa nako ni xDDD
		$putdata = file_get_contents("php://input");
		$keywords = preg_split("/[------]+/", $putdata);
		$parsed_val = Array();
		foreach ($keywords as $key => $value) {
			if(strpos($value, 'WebKitForm') !== 0 && strpos($value, 'Disposition') !== 0 && !empty($value)){
				$current_val = preg_replace('/[\s]+/', '', $value);
				$current_val = substr($current_val, 10, strlen($current_val));
				if ($current_val !== false){
					$current_val = preg_split("/\"+/", $current_val, -1, PREG_SPLIT_NO_EMPTY);
					$parsed_val[$current_val[0]] = $current_val[1];
				}
			}
		}
		return  $parsed_val[$param_name];
	}

	public static function PARAMFILE($param_name)
	{
		if (isset($_FILES[$param_name]))
			return $_FILES[$param_name];
		else
			return null;
	}
}
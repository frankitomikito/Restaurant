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
			echo $callback();
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

	public static function PARAMFILE($param_name)
	{
		if (isset($_FILES[$param_name]))
			return $_FILES[$param_name];
		else
			return null;
	}
}
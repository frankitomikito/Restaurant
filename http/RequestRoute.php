<?php 

require_once('Interfaces/IRequestMethod.php');
require_once('Response.php');

class RequestRoute extends Response implements IRequestMethod {


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
			echo $callback();
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
}
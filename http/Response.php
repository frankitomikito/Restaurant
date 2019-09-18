<?php 

class Response {

	public $data;

	public function __construct($data, $response_code) {
		http_response_code($response_code);
		$this->data = json_encode($data);
	}
}
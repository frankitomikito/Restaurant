<?php 

require_once('Interfaces/IDatabaseAction.php');

class Database implements IDatabaseAction {

	private $servername = "localhost";
	private $username = "root";
	private $password = "";
	private $dbName = "restaurant_v2";
	private $conn;

	public function rawQuery($query)
	{
		$this->connect();
		$result =  $this->conn->query($query);
		$this->disconnect();
		return $result;
	}

	private function connect()
	{
		$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbName);
		if ($this->conn->connect_error)
			die("Connection failed: ".$this->conn->connect_error);
	}

	private function disconnect()
	{
		$this->conn->close();
	}
}
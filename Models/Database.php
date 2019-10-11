<?php 

require_once('Interfaces/IDatabaseAction.php');
require_once('../dbconfig.php');

class Database implements IDatabaseAction {

	private $servername = DbConfig::SERVER;
	private $username = DbConfig::USERNAME;
	private $password = DbConfig::PASSWORD;
	private $dbName = DbConfig::DBNAME;
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

	public function convertResultToJson($result) {
		if ($result->num_rows > 0) {
			$array = Array();
			while($row = $result->fetch_object()) {
				$array[] = $row;
			}
			return $array;
		}
		else
			return [];
	}

	public function convertResultToDatatableArray($result) {
		if ($result->num_rows > 0) {
			$array = Array();
			while($row = $result->fetch_all()) {
				for ($i=0; $i < sizeof($row); $i++) { 
					$array[] = $row[$i];
				}
			}
			return $array;
		}
		else 
			return [];
	}
}
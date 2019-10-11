<!-- dbCon.php -->
<?php 
require_once('../dbconfig.php');
function connect($flag=TRUE){
	$servername = DbConfig::SERVER;
	$username = DbConfig::USERNAME;
	$password = DbConfig::PASSWORD;
	$dbName = DbConfig::DBNAME;

	// Create connection
	if($flag){
		$conn = new mysqli($servername, $username, $password,$dbName);
	}else{
		$conn = new mysqli($servername, $username, $password);
	}
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: $conn->connect_error");
	} 
	//echo "Connected successfully";
	
	return $conn;
}

?>
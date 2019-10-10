<!-- dbCon.php -->
<?php 
function connect($flag=TRUE){
	$servername = "localhost";
	$username = "id11174334_emmasama";
	$password = "emmasama";
	$dbName = "id11174334_restaurant";

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

<?php
require_once('../dbconfig.php');

$db_name = DbConfig::DBNAME;
$mysql_username = DbConfig::USERNAME;
$mysql_password = DbConfig::PASSWORD;
$server_name = DbConfig::SERVER;
$conn = mysqli_connect($server_name, $mysql_username, $mysql_password, $db_name);
?>
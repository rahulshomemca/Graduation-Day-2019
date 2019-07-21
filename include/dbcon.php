<?php
//Create Connection
$db_host = 'localhost';
$db_name = 'graduationday';
$db_user = 'xxxx';
$db_pass = 'xxxx';

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

if($mysqli->connect_error){
	printf("connection Error: %s",$mysqli->connect_error);
	exit();
}

?>

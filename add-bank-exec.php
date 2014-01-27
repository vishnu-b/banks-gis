<?<?php

$latLng = array();
$latLngArr = array();
//$boundArr = array();
$j = 0;
$l = 0;

$username = "admin";
$password = "yahoo";
$host = "localhost";
$database = "banks";
$con = new mysqli($host, $username, $password, $database);
if($con->connect_errno){
	echo "Failed to connect to Database:(" . $con->connect_errno . ")" . $con->connect_error;
}
$bankName = $_POST['bankName'];
$abbr = $_POST['abbr'];
$location = $_POST['location'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
$opBalance = $_POST['opBalance'];
$clBalance = $_POST['clBalance'];

$create = $con->query("CREATE TABLE IF NOT EXISTS bank_details(chest_id INT(5) PRIMARY KEY, name VARCHAR(55), abbr VARCHAR(10),
	place VARCHAR(20), latitude VARCHAR(30), longitude VARCHAR(30), district VARCHAR(30), opening_balance VARCHAR(12), closing_balance VARCHAR(12), date DATE)");
if(!$create)
{
	echo $con->error;
}
$insert = $con->query("INSERT INTO bank_details(name, abbr, place, latitude, longitude, district, opening_balance, closing_balance)
	VALUES('$bankName', '$abbr', '$location', '$lat', '$lng', '$location', '$opBalance', '$clBalance')");

header('location:index.php');
	
?>

<?php

	$host = 'localhost';
	$username = 'admin';
	$password = 'yahoo';
	$database = 'banks';

	$con = new mysqli($host, $username, $password, $database);

	if($con->connect_errno)
		echo "Failed to connect to Database Server:(" . $con->connect_errno . ")" . $con->connect_error;

	function parseToXML($htmlStr)
	{
		$xmlStr=str_replace('<','&lt;',$htmlStr); 
		$xmlStr=str_replace('>','&gt;',$xmlStr); 
		$xmlStr=str_replace('"','&quot;',$xmlStr); 
		$xmlStr=str_replace("'",'&#39;',$xmlStr); 
		$xmlStr=str_replace("&",'&amp;',$xmlStr); 
		return $xmlStr; 
	}

	header("Content-type: text/xml");
	echo '<banks>';

	$result = $con->query("SELECT * FROM bank_details");
	while($row = mysqli_fetch_array($result))
	{
		echo '<bank ';
		echo 'chestId="'. $row['chest_id'] . '" ';
		echo 'name="'. $row['name'] . '" ';
		echo 'abbr="'. $row['abbr'] . '" ';
		echo 'lat="'. $row['latitude'] . '" ';
		echo 'lng="'. $row['longitude'] . '" ';
		echo 'district="'. $row['district'] . '" ';
		echo 'balance="'. $row['closing_balance'] . '" ';
		echo "/>";
	}
	echo "</banks>";

?>
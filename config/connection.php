<?php
$servername = "localhost";
$username = "root";
$password = "240498";
$dbname = "camagru";

try {
	//echo "something";
	$conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo "We have arrive to the connection<br/>";
} catch (PDOException $e) {
	echo "Connection Failed: " . $e->getMessage();
}

//$conn = null;

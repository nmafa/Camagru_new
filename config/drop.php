<?php

$servername = "localhost";
$username = "root";
$password = "240498";
$dbname = "camagru";


// DROP DATABASE
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DROP DATABASE `" . $dbname . "`";
    $conn->exec($sql);
    echo "Database droped successfully<br>";
} catch (PDOException $e) {
    echo "ERROR DROPING DB: <br>" . $e->getMessage() . "<br>";
}

<?php

$servername = "localhost";
$username = "root";
$password = "240498";
$dbname = "camagru";


// CREATE DATABASE
try {
    // Connect to Mysql server
    $dbh = new PDO("mysql:host=$servername", $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS `" . $dbname . "`";
    $dbh->exec($sql);
    echo "Database created successfully <br>";
    echo "<a href='./createTables.php'>Setup Tables</a>";
} catch (PDOException $e) {
    echo "ERROR CREATING DB: <br>" . $e->getMessage() . "<br>Aborting process<br>";
    exit(-1);
}

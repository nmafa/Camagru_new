<?php

require_once('./connection.php');


// CREATE TABLE USERS
try {
	// Connect to DATABASE previously created

	$sql = "CREATE TABLE `users` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
`username` VARCHAR(50) NOT NULL,
`mail` VARCHAR(100) NOT NULL,
`password` VARCHAR(255) NOT NULL,
`token` VARCHAR(50) NOT NULL,
`verified` VARCHAR(1) NOT NULL DEFAULT '0'
)";
	$conn->exec($sql);
	echo "Table users created successfully<br>";
} catch (PDOException $e) {
	echo "ERROR CREATING TABLE: " . $e->getMessage() . "<br>Aborting process<br>";
}

// CREATE TABLE GALLERY
try {
	// Connect to DATABASE previously created

	$sql = "CREATE TABLE `gallery` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
`userid` INT(11) NOT NULL,
`img` VARCHAR(100) NOT NULL,
FOREIGN KEY (userid) REFERENCES users(id)
)";
	$conn->exec($sql);
	echo "Table gallery created successfully<br>";
} catch (PDOException $e) {
	echo "ERROR CREATING TABLE: " . $e->getMessage() . "<br>Aborting process<br>";
}

// CREATE TABLE LIKE
try {
	// Connect to DATABASE previously created

	$sql = "CREATE TABLE `like` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
`userid` INT(11) NOT NULL,
`galleryid` INT(11) NOT NULL,
`type` VARCHAR(1) NOT NULL,
FOREIGN KEY (userid) REFERENCES users(id),
FOREIGN KEY (galleryid) REFERENCES gallery(id)
)";
	$conn->exec($sql);
	echo "Table like created successfully<br>";
} catch (PDOException $e) {
	echo "ERROR CREATING TABLE: " . $e->getMessage() . "<br>Aborting process<br>";
}

// CREATE TABLE COMMENT
try {
	// Connect to DATABASE previously created

	$sql = "CREATE TABLE `comment` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
`userid` INT(11) NOT NULL,
`galleryid` INT(11) NOT NULL,
`comment` VARCHAR(255) NOT NULL,
FOREIGN KEY (userid) REFERENCES users(id),
FOREIGN KEY (galleryid) REFERENCES gallery(id)
)";
	$conn->exec($sql);
	echo "Table comment created successfully<br>";
} catch (PDOException $e) {
	echo "ERROR CREATING TABLE: " . $e->getMessage() . "<br>Aborting process<br>";
}

<?php
require_once './config/connection.php';

if (isset($_GET['delete'])) {

	try {
		$galleryID = $_GET['delete'];
		$user_id = $_SESSION['id'];

		$userid = $_GET['userid'];

		$stmt2 = $conn->prepare("SELECT mail, username FROM users WHERE id = " . $userid);
		$stmt2->execute();
		if ($user = $stmt2->fetch(PDO::FETCH_ASSOC)) {
			$mail = $user['mail'];
			$username = $user['username'];
		}

		$sql = "DELETE FROM gallery WHERE id = " . $galleryID;

		$stmt = $conn->prepare($sql);
		$stmt->execute();
	} catch (PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
	}

	$conn = null;
}

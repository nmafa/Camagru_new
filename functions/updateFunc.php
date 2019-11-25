<?php
include_once('./config/connection.php');
session_start();
$err = "";


if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
	$username = htmlspecialchars($_POST['username']);
	$mail = htmlspecialchars($_POST['email']);
	$password = htmlspecialchars($_POST['password']);
	$password = hash('sha1', $password);

	if (!empty($username) && !empty($mail) && !empty($password)) {

		try {
			$sql = "UPDATE `users` SET `username` = '$username', `mail` = '$mail', `password` = '$password' WHERE `users`.`id` = $_SESSION[id]";
			$arr = array($username, $mail, $password);
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			if (isset($_POST['notification'])) {
				$subject = "[CAMAGRU] - update - ALL";

				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
				$headers .= 'From: <nmafa@student.wethinkcode.co.za>' . "\r\n";

				$message = '
  <html>
    <head>
      <title>' . $subject . '</title>
    </head>
    <body>
      Hello ' . htmlspecialchars($username) . ' </br>
      You have successfully updated your information :  </br>
    </body>
  </html>
  ';

				mail($mail, $subject, $message, $headers);
			}
			$err = " UPDATED successfully";
		} catch (PDOException $e) {
			$err = "Update: " . "<br>" . $e->getMessage();
		}
	} else {
		//for username
		if (!empty($username)) {
			try {



				$sql = "UPDATE `users` SET `username` = '$username' WHERE `users`.`id` = $_SESSION[id]";
				$stmt = $conn->prepare($sql);
				$stmt->execute();







				$stmt2 = $conn->prepare("SELECT mail FROM users Where id = $_SESSION[id]");
				$stmt2->execute();
				if ($stmt2->rowCount() > 0) {
					while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
						extract($row);
						$row['mail'];
					}
				}





				if (isset($_POST['notification'])) {
					$subject = "[CAMAGRU] - update - username";

					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
					$headers .= 'From: <nmafa@student.wethinkcode.co.za>' . "\r\n";

					$message = '
  <html>
    <head>
      <title>' . $subject . '</title>
    </head>
    <body>
      Hello ' . htmlspecialchars($username) . ' </br>
      Your username has been updated successfully.  </br>
    </body>
  </html>
  ';

					mail($mail, $subject, $message, $headers);
				}
				$err = " username UPDATED successfully";
			} catch (PDOException $e) {
				$err = "username: " . "<br>" . $e->getMessage();
			}
			//for email
		} else if (!empty($mail)) {
			if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
				$err = "Enter a  valid email";
			} else {
				try {

					$sql = "UPDATE users SET mail = '$mail' WHERE id = $_SESSION[id]";
					$stmt = $conn->prepare($sql);
					$stmt->execute();



					if (isset($_POST['notification'])) {
						$subject = "[CAMAGRU] - update - email";

						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
						$headers .= 'From: <nmafa@student.wethinkcode.co.za>' . "\r\n";

						$message = '
  <html>
    <head>
      <title>' . $subject . '</title>
    </head>
    <body>
      Hello ' . htmlspecialchars($username) . ' </br>
      Your email was successfully updated.  </br>
    </body>
  </html>
  ';

						mail($mail, $subject, $message, $headers);
					}
					$err = " E-mail UPDATED successfully";
				} catch (PDOException $e) {
					$err = "E-mail: " . "<br>" . $e->getMessage();
				}
			}
			//for password
		} else if (!empty($password)) {
			if (strlen($password) <= 6 && ctype_lower($password)) {
				$err = "Password not strong enough!";
			} else {
				try {

					$sql = "UPDATE users SET `password` = '$password' WHERE id = $_SESSION[id]";
					$stmt = $conn->prepare($sql);
					$stmt->execute();






					$stmt2 = $conn->prepare("SELECT mail FROM users Where id = $_SESSION[id]");
					$stmt2->execute();
					if ($stmt2->rowCount() > 0) {
						while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
							extract($row);
							$row['mail'];
						}
					}


					if (isset($_POST['notification'])) {
						$subject = "[CAMAGRU] - update - password";

						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
						$headers .= 'From: <nmafa@student.wethinkcode.co.za>' . "\r\n";

						$message = '
  <html>
    <head>
      <title>' . $subject . '</title>
    </head>
    <body>
      Hello ' . htmlspecialchars($username) . ' </br>
      There is your new password :  </br>
    </body>
  </html>
  ';

						mail($mail, $subject, $message, $headers);
					}
					$err =  "Password changed successfully";
				} catch (PDOException $e) {
					$err = "Password: " . "<br>" . $e->getMessage();
				}
			}
		} else {
			$err = "nothing to update";
		}
	}
}

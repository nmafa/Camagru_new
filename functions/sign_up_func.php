<?php
include_once('../config/connection.php');

$err = "";
$token = "null";
if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
	$username = htmlspecialchars($_POST['username']);
	$mail = htmlspecialchars($_POST['email']);
	$password = htmlspecialchars($_POST['password']);



	if (empty($username) || empty($mail) || empty($password)) {
		$err = 'fill in all fields!';
	} else {
		if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
			$err = "Enter a  valid email";
		} else {
			if (strlen($password) <= 6 && ctype_lower($password)) {
				$err = "Password not strong enough!";
			} else {
				$password = hash('sha1', $password);
				$sthandler = $conn->prepare("SELECT username, mail FROM users WHERE Username = :username OR mail = :mail");
				$sthandler->bindParam(':username', $username);
				$sthandler->bindParam(':mail', $email);
				$sthandler->execute();

				if ($sthandler->rowCount() > 0) {
					$err = "user exists!";
				} else {


					try {
						$stmt = $conn->prepare("INSERT INTO `users` (username, mail,`password`, token) values (?,?,?,?) ");
						$token = uniqid(rand(), true);
						$arr = array($username, $mail, $password, $token);
						if ($stmt->execute($arr)) {

							$sql = "SELECT * FROM users WHERE username = ?";
							$stmt = $conn->prepare($sql);
							$stmt->execute([$username]);
							$results = $stmt->fetch(PDO::FETCH_ASSOC);


							$subject = "[CAMAGRU] - Email verification";
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
                                To finalize the last step of your registration please click the link
                                <a href="http://localhost:8080/nmafa/camagru/forms/verify_form.php?token=' . $token . '">Verify my email</a>
                                </body>
                            </html>';


							// send email
							mail($mail, $subject, $message, $headers);
						}
						$err = "user added, check your email.";
					} catch (PDOException $e) {
						echo "Add user Failed: " . $e->getMessage();
					}
				}
			}
		}
	}
}

<?php
require('../functions/sign_up_func.php');
?>

<html>

<head>
	<title>Sign Up Form</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">

</head>

<Body>
	<div class="SignUpbox">
		<img src="../img/ava.jpeg" class="ava">
		<h1>Sign Up</h1>
		<form action="./signup_Form.php" method="POST">
			<p>Username</p>
			<input type="text" name="username" placeholder="Enter Username">
			<p>Email</p>
			<input type="text" name="email" placeholder="Enter Email">
			<p>Password</p>
			<input type="password" name="password" placeholder="Enter Password">
			<input type="submit" name="" value="Sign Up">
			<a href="../index.php">Loggin? <br /></a>
			<?php echo $err; ?>
		</form>
</Body>

</html>
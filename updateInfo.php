<?php
require('./functions/updateFunc.php');
?>

<html>

<head>
	<title>Update Form</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">

</head>
<?php include './includes/header.php'; ?>

<Body>
	<div class="SignUpbox">
		<img src="./img/ava.jpeg" class="ava">
		<h1>Update Info</h1>
		<form action="./updateInfo.php" method="POST">
			<p>Username</p>
			<input type="text" name="username" placeholder="Enter Username">
			<p>Email</p>
			<input type="text" name="email" placeholder="Enter Email">
			<p>Password</p>
			<input type="password" name="password" placeholder="Enter Password">
			<input type="checkbox" name="notification">Email notification
			<input type="submit" name="submit" value="Save">

			<?php echo $err; ?>
		</form>
</Body>

</html>
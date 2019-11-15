<?php
session_start();
?>
<!DOCTYPE html>
<HTML>
<header>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="./css/style.css">
  <title>camagru-forgot</title>
</header>

<body>
  <?php include('./includes/header.php') ?>
  <div class="loginbox">
    <img src="./img/emoji.jpg" class="emoji">
    <h2>Forgot password form</h2>
    <form method="post" action="./forms/forgot_form.php">
      <p>Email: </p>
      <input id="mail" name="email" type="text">
      <input name="submit" type="submit" value=" SEND ">
    </form>
    <?php
    echo $_SESSION['error'];
    $_SESSION['error'] = null;
    if (isset($_SESSION['forgot_success'])) {
      echo "An email has been sent to your email address";
      $_SESSION['forgot_success'] = null;
    }
    ?>
</body>

</HTML>
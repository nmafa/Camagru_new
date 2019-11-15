<?php
session_start();
?>
<!DOCTYPE html>
<HTML>
<header>
  <link rel="stylesheet" type="text/css" href="./css/style.css">
  <link rel="stylesheet" type="text/css" href="../css/header.css">
  <meta charset="UTF-8">
  <title>camagru</title>
</header>

<body class="body">


  <?php if (isset($_SESSION['id'])) { ?>
    <?php include './includes/header.php' ?>
    <h2 class="welcome"> Welcome to Camagru <?php print_r(htmlspecialchars($_SESSION['username'])) ?>
    <?php } else { ?>


      <div class="loginbox">
        <img src="./img/emoji.jpg" class="emoji">
        <h1>Login Here</h1>
        <form method="post" action="./forms/login.php">
          <p>Email: </p>
          <input id="mail" name="email" type="text">
          <p>Password: </p>
          <input id="password" name="password" type="password">

          <input name="submit" type="submit" value="sign in">
          <a href="./forms/signup_form.php">Sign-up</a><br>
          <a href="./forgot_password.php">forgot Password?</a>
        </form>
        <?php
          if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
          }
          $_SESSION['error'] = null;
          ?>
      </div>
    <?php } ?>
</body>

</HTML>
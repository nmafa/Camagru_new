<?php

include '../functions/forgot_password.php';

// retreive values
$mail = htmlspecialchars($_POST['email']);

$_SESSION['error'] = null;

if (($res = reset_password($mail)) !== 0) {
  if ($res == -1) {
    $_SESSION['error'] = "User Not Found!";
  } else {
    $_SESSION['error'] = "internal error";
  }
} else {
  $_SESSION['forgot_success'] = true;
}

header("Location: ../forgot_password.php");

<?php
session_start();

include '../functions/login.php';

// retreive values
$mail = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);

if (($val = log_user($mail, $password)) == -1) {
  $_SESSION['error'] = "User Not Found!";
} else if (isset($val['err'])) {
  $_SESSION['error'] = $val['err'];
} else {
  $_SESSION['id'] = $val['id'];
  $_SESSION['username'] = $val['username'];
}

header("Location: ../index.php");

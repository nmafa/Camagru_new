<?php
session_start();
include_once '../functions/verify_func.php';
?>
<!DOCTYPE html>
<HTML>
  <header>
    <meta charset="UTF-8">
    <title>CAMAGRU - VERIFY</title>
  </header>
  <body>
    <h2>verification</h2>
    <?php if (verify($_GET["token"]) == 0) { ?>
        Your account as been verified you can <a href="../index.php">log in</a>
    <?php } else { ?>
        Account not found 
    <?php } ?>
  </body>
</HTML>

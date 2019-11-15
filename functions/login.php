<?php

function log_user($userMail, $password) {
  include_once '../config/database.php';

  try {
      $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query= $dbh->prepare("SELECT id, username FROM users WHERE mail=:mail AND password=:password AND verified='1'");
      $userMail = strtolower($userMail);
      $password = hash('sha1', $password);
      $query->execute(array(':mail' => $userMail, ':password' => $password));

      $val = $query->fetch();
      if ($val == null) {
          $query->closeCursor();
          return (-1);
      }
      $query->closeCursor();

      return ($val);
    } catch (PDOException $e) {
      $v['err'] = $e->getMessage();
      return ($v);
    }
}

?>

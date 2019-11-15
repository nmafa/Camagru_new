<?php

function verify($token)
{
  include_once '../config/connection.php';

  try {

    $query = $conn->prepare("SELECT id FROM users WHERE token=:token");
    $query->execute(array(':token' => $token));

    $val = $query->fetch();
    if ($val == null) {
      return (-1);
    }
    $query->closeCursor();

    $query = $conn->prepare("UPDATE users SET verified='1' WHERE id=:id");
    $query->execute(array('id' => $val['id']));
    $query->closeCursor();
    return (0);
  } catch (PDOException $e) {
    return (-2);
  }
}

<?php

  session_start();

  include '../scripts/connection.php';

  $isbn = $_SESSION['email'];
  $pass = $_POST['password'];

  try {

    $qry = "UPDATE $dbname.users SET password = $pass WHERE email = '$isbn'";

    $result = $db->query($qry);

    if ($result) {
      echo "passupdated";
    }

  } catch (Exception $e) {
    echo $e->getMessage();
  }


 ?>

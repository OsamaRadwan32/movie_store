<?php

include '../../scripts/connection.php';

session_start();

$user_id = $_SESSION['email'];
$pass = $_POST['password'];

try {

  $qry = "UPDATE $dbname.user SET password = $pass WHERE email = $user_id ";

  $result = $db->query($qry);

  if ($result) {
    echo "updated";
  }
} catch (Exception $e) {
  echo $e->getMessage();
}

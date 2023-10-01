<?php
require_once 'connection.php';

$email = $_POST['email'];
$pass = $_POST['password'];

try {
  $qry = "SELECT count(*) FROM $dbname.users WHERE email = '$email' AND password = '$pass'";
  $valid = $db->query($qry)->fetchColumn();

  if ($valid > 0) {

    session_start();

    $qry = "SELECT * FROM $dbname.users WHERE email = '$email' AND password = '$pass'";

    $result = $db->query($qry);
    $row = $result->fetch(PDO::FETCH_ASSOC);

    $_SESSION['id'] = $row['id'];
    $_SESSION['firstname'] = $row['firstname'];
    $_SESSION['lastname'] = $row['lastname'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['gender'] = $row['gender'];
    $_SESSION['date_of_birth'] = $row['date_of_birth'];
    $_SESSION['role'] = $row['role'];

    echo "Login " . $_SESSION['role'];

  } else {
    echo "error";
  }

} catch (Exception $e) {
  echo $e->getMessage();
}

?>

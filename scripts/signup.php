<?php

include 'connection.php';

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['user_email'];
$gender = $_POST['gender'];
$password = $_POST['password'];

try {

  $sql = "SELECT AUTO_INCREMENT AS last FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'the_movie_store' AND TABLE_NAME = 'users'";
  $qry = $db->prepare($sql);
  $qry->execute();
  $result = $qry->fetch(PDO::FETCH_ASSOC);

  $newID = $result['last'];

  $sql = null;
  $qry = null;
  $result = null;

  $pass = strtolower($fname) . strtolower($lname) . $newID;

  $qry = "INSERT INTO $dbname.users (firstname, lastname, email, password, gender, role) VALUES('$fname', '$lname', '$email', '$password', '$gender', 1)";

  $result = $db->query($qry);

  if ($result) {
    echo "Inserted Successfully";
  }
} catch (Exception $e) {
  echo $e->getMessage();
}

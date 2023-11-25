<?php

include '../../scripts/connection.php';

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['user_email'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$type = $_POST['type'];
$countryId = $_POST['country'];

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

  $qry = "INSERT INTO $dbname.users (firstname, lastname, email, password, date_of_birth, gender, country_id, role) VALUES('$fname', '$lname', '$email', '$pass', $dob, '$gender', $countryId, $type)";

  $result = $db->query($qry);

  if ($result) {
    echo "Inserted Successfully";
  }
} catch (Exception $e) {
  echo $e->getMessage();
}

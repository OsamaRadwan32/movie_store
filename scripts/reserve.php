<?php
session_start();
require_once 'connection.php';

$userid = $_SESSION['id'];
$id = $_POST['id'];
$address = $_POST['address'];
$price = $_POST['price'];

try {
  $qry = "INSERT INTO $dbname.orders (user_id, movie_id, price, address) VALUES($userid, $id, $price, '$address')";
  $result = $db->query($qry);

  if ($result) {
    echo "inserted";
  }
} catch (Exception $e) {
  echo $e->getMessage();
}

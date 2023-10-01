<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'the_movie_store';

try {
  $db = new PDO("mysql: host = $servername; dbname = $dbname", $username, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $e) {
  echo "Connection failed: " . $e->getMessage();
  exit;
}
?>

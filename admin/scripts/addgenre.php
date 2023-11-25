<?php

include '../../scripts/connection.php';

$genre_name = $_POST['genre'];

try {


  $sql = "INSERT INTO $dbname.genre (name) VALUES('$genre_name')";

  $result = $db->query($sql);

  if ($result) {
    echo "Inserted Successfully";
  }
} catch (Exception $e) {
  echo $e->getMessage();
}

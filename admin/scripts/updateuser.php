<?php

  include '../../scripts/connection.php';

  $user_id = $_POST['userid'];
  $type = $_POST['selectType'];
  $value = $_POST['value'];

  try {

    $qry = "UPDATE library.user SET $type = '$value' WHERE user_id = $user_id";
    $result = $db->query($qry);

    if ($result) {
      echo "updated";
    }

  } catch (Exception $e) {
    echo $e->getMessage();
  }

 ?>

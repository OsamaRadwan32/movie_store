<?php

  include '../../scripts/connection.php';

  $isbn = $_POST['isbn'];
  $type = $_POST['selectType'];
  $value = $_POST['selectValue'];

  try {

    if ($type == 'qty') {
      $qry = "UPDATE " . "library.books set " . $type . " = " . $value . " WHERE isbn = '" . $isbn . "'";
    } else {
      $qry = "UPDATE " . "library.books set " . $type . " = '" . $value . "' WHERE isbn = '" . $isbn . "'";
    }

    $result = $db->query($qry);

    if ($result) {
      echo "updated";
    }

  } catch (Exception $e) {
    echo $e->getMessage();
  }


 ?>

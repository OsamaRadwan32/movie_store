<?php
  require_once '../../scripts/connection.php';

  $reqid = $_POST['requestid'];

  try {

    $max_date = date('Y-m-d', strtotime('+2 Week'));

    $qry = "UPDATE library.request_status SET taken = 1, date_maxreturned = '$max_date' WHERE rs_id = $reqid";
    $result = $db->query($qry);

    if ($result) {
      echo "inserted";
    }

  } catch (Exception $e) {
    echo $e->getMessage();
  }

 ?>

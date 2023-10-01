<?php
  require_once '../../scripts/connection.php';

  $reqid = $_POST['requestid'];
  $isbn = $_POST['isbn'];

  try {

    $date = date('Y-m-d');

    $sql = "UPDATE library.request_status SET returned = 1, date_returned = '$date' WHERE rs_id = $reqid";
    $result = $db->query($sql);

    $sql2 = "UPDATE library.books SET count_borrowed = count_borrowed - 1 WHERE isbn = '$isbn'";
    $result2 = $db->query($sql2);

    if ($result && $result2) {
      echo "returned";
    }

  } catch (Exception $e) {
    echo $e->getMessage();
  }

 ?>

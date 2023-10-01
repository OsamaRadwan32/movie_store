<?php
  require_once 'connection.php';
  session_start();
  $user_id = $_SESSION['user_id'];
  try {

    $noti = array();
    $sql = "SELECT title from library.request_status, library.books where request_status.isbn = books.isbn and returned = 0 and date_maxreturned = CURRENT_DATE and user_id = $user_id";
    $qry = $db->prepare($sql);
    $qry->execute();

    while ($row = $qry->fetch(PDO::FETCH_ASSOC)) {
      $noti['titles'][] = $row;
    }

    echo json_encode($noti);

  } catch (Exception $e) {
    echo $e->getMessage();
  }

 ?>

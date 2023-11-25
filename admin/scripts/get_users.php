<?php
require_once '../../scripts/connection.php';
try {

  $users = array();
  $sql = "SELECT user_id, CONCAT(fname, ' ' ,lname) AS name, email, gender, dob, permission FROM library.user ORDER BY permission, user_id";
  $qry = $db->prepare($sql);
  $qry->execute();

  while ($row = $qry->fetch(PDO::FETCH_ASSOC)) {
    $users['users'][] = $row;
  }

  echo json_encode($users);
} catch (Exception $e) {
  echo $e->getMessage();
}

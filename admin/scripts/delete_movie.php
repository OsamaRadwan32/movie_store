<?php

include '../../scripts/connection.php';

$isbn = $_REQUEST['isbn'];

try {
  $qry = "DELETE FROM " . "library.books WHERE isbn = '" . $isbn . "'";

  $result = $db->query($qry);

  if ($result) {
    echo "Deleted";
  } else {
    echo "Error deleteion";
  }
} catch (Exception $e) {
  echo $e->getMessage();
}

<?php

require_once '../../scripts/connection.php';

$sql = "SELECT AUTO_INCREMENT AS last FROM " . "INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'the_movie_store' AND TABLE_NAME = 'users'";
$qry = $db->prepare($sql);
$qry->execute();
$result = $qry->fetch(PDO::FETCH_ASSOC);

$newID = $result['last'];

echo $newID;

<?php

require_once 'connection.php';
session_start();
$user_id = $_SESSION['id'];
$rating = $_POST['rating'];
$movie_id = $_POST['movie_id'];

try {

	$qry = "INSERT INTO $dbname.user_rating (user_id, movie_id, rating) VALUES($user_id, $movie_id, $rating)";
	$result = $db->query($qry);

	if ($result)
	  	echo "success";
	  
} catch (Exception $e) {
	echo $e->getMessage();
}

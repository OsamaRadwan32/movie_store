<?php

require_once 'connection.php';
require_once 'recommend.php';

$matrix = array();

$email = '';

$movies_sql = "SELECT * FROM $dbname.user_rating";
$qry = $db->prepare($movies_sql);
$qry->execute();
$movies = $qry->fetchAll(PDO::FETCH_ASSOC);

foreach ($movies as $movie) {

	$movie_id = $movie['movie_id'];
	$movie_rating = $movie['rating'];
	$user_id = $movie['user_id'];

	$user_sql = "SELECT email FROM $dbname.users WHERE id = $user_id";
	$user_query = $db->query($user_sql);
	$user_email = $user_query->fetch(PDO::FETCH_ASSOC);

	$single_movie_sql = "SELECT name FROM $dbname.movies WHERE id = $movie_id";
	$single_movie_query = $db->query($single_movie_sql);
	$single_movie = $single_movie_query->fetch(PDO::FETCH_ASSOC);

	$matrix[$user_email['email']][$single_movie['name']] = $movie_rating;
}


$array = getRecommendation($matrix, 'user@user.com');
foreach ($array as $key => $value) {
	echo $key . '<br>';
}

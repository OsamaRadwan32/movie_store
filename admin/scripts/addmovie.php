<?php

  include '../../scripts/connection.php';

  $movie_name = $_POST['movie_name'];
  $slug = $_POST['slug'];
  $description = $_POST['description'];
  $story_line = $_POST['story_line'];
  $release_year = $_POST['release_year'];
  $price = $_POST['price'];
  

  try {

    $qry = "INSERT INTO $dbname.movies (name, slug, description, story_line, release_year, price) VALUES('$movie_name', '$slug', '$description', '$story_line', $release_year, '$price')";

    $result = $db->query($qry);

    if ($result) {
      echo "Inserted Successfully";
    }

  } catch (Exception $e) {
    echo $e->getMessage();
  }

 ?>

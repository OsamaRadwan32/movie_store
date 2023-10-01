<?php

  require_once 'connection.php';

  $q = $_POST['search'];
  $searchBy = $_POST['searchBy'];
  $sortBy = $_POST['sortBy'];
  $order = $_POST['order'];

  // echo $q . ' ' . $searchBy . ' ' . $sortBy . ' ' . $order;

  try {

    $movies = array();
    $stmt = "SELECT * FROM $dbname.movies WHERE $searchBy LIKE '%$q%' ORDER BY $sortBy $order";

    $qry = $db->prepare($stmt);
    $qry->execute();

    $i = 0;
    while ($row = $qry->fetch(PDO::FETCH_ASSOC)) {

      $movie_id = $row['id'];
      
      $movies['movies'][] = $row;

      $sql_g = "SELECT g.name FROM $dbname.genre as g, $dbname.genre_movie as gm WHERE gm.movie_id = $movie_id and g.id = gm.genre_id";
      $qry_g = $db->query($sql_g);
      $genres = $qry_g->fetchAll(PDO::FETCH_ASSOC);

      $sql_r = "SELECT AVG(rating) as avg FROM $dbname.user_rating WHERE movie_id = $movie_id";
      $rating_value = $db->query($sql_r)->fetchColumn();
      $movies['movies'][$i]['rating'] = $rating_value == null ? 0 : $rating_value;

      $sql_g = "SELECT g.name FROM $dbname.genre as g, $dbname.genre_movie as gm WHERE gm.movie_id = $movie_id and g.id = gm.genre_id";
          $qry_g = $db->prepare($sql_g);
      $qry_g->execute();

      $genres = '';

      while ($genre_row = $qry_g->fetch(PDO::FETCH_ASSOC)) {
        $genres .= $genre_row['name'] . ', ';
      }

      $movies['movies'][$i++]['genres'] = $genres;
    }



    echo json_encode($movies);

  } catch (Exception $e) {
    echo $e->getMessage();
  }

 ?>

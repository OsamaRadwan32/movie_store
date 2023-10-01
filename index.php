<?php
  $pageTitle = 'Home';
  $headerClass = '';
  $bodyClass = 'home';
  include 'scripts/header.php';
?>

<?php include 'scripts/connection.php'; ?>

    <!-- Main Content -->
    <div class="main-content container">
      <!-- Most Popular Books -->
      <div class="row">
        <div class="topic">
          <h3>Most Popular</h3>
        </div>
        <div class="row">
          <?php

            try {

              $sql = "SELECT m.id, m.name, m.slug from $dbname.movies as m, (select count(movie_id) as mcount, movie_id from $dbname.orders GROUP by movie_id ORDER by COUNT(movie_id) DESC) as o where m.id = o.movie_id limit 5";
              $qry = $db->prepare($sql);
              $qry->execute();
              $results = $qry->fetchAll(PDO::FETCH_ASSOC);

            } catch (Exception $e) {
              echo $e->getMessage();
            }

           ?>

           <?php foreach ($results as $row) { ?>
            <article class="col-4">
              <div class="article-padding">
                <figure class="thumbnail">
                  <a href="movie.php?id=<?php echo $row['id']; ?>">
                    <img src="img/movies/<?php echo $row['slug']; ?>.jpg" alt="<?php echo $row['name']; ?>">
                  </a>
                </figure>
                <div class="caption">
                  <a href="movie.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a>
                </div>
              </div>
            </article>
          <?php } ?>

        </div>
      </div>

      <!-- New Releases -->
      <div class="row">
        <div class="topic">
          <h3>New Releases</h3>
        </div>
        <div class="row">

          <?php

            try {

              $sql = "SELECT id, name, slug FROM $dbname.movies ORDER BY reg_date DESC LIMIT 5";
              $qry = $db->prepare($sql);
              $qry->execute();
              $results = $qry->fetchAll(PDO::FETCH_ASSOC);

            } catch (Exception $e) {
              echo $e->getMessage();
            }

           ?>

           <?php foreach ($results as $row) { ?>
            <article class="col-4">
              <div class="article-padding">
                <figure class="thumbnail">
                  <a href="movie.php?id=<?php echo $row['id']; ?>">
                    <img src="img/movies/<?php echo $row['slug']; ?>.jpg" alt="<?php echo $row['name']; ?>">
                  </a>
                </figure>
                <div class="caption">
                  <a href="movie.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a>
                </div>
              </div>
            </article>
          <?php } ?>

        </div>
      </div>

      <?php 

      if (isset($_SESSION['id'])) {
          $login_user_id = $_SESSION['id'];
          $user_rating_exist_sql = "SELECT * FROM $dbname.user_rating WHERE user_id = $login_user_id";
          $user_rating_exist_qry = $db->prepare($user_rating_exist_sql);
          $user_rating_exist_qry->execute();
      }

      if (isset($_SESSION['email']) && $user_rating_exist_qry->rowCount() > 0) : ?>

      <!-- You Might Like -->
      <div class="row">
        <div class="topic">
          <h3>Recommended For You</h3>
        </div>
        <div class="row">
        <?php

          require_once 'scripts/recommend.php';

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
           

          $array = getRecommendation($matrix, $_SESSION['email']);

          ?>

           <?php 
           $i = 0;
           foreach ($array as $key => $value) { 
            if ($i == 5)
              break;

            $i++;

            $recommend_movie_sql = "SELECT * FROM $dbname.movies WHERE name = '$key'";
            $recommend_movie_query = $db->query($recommend_movie_sql);
            $recommend_movie = $recommend_movie_query->fetch(PDO::FETCH_ASSOC);
            ?>
            <article class="col-4">
              <div class="article-padding">
                <figure class="thumbnail">
                  <a href="movie.php?id=<?php echo $recommend_movie['id']; ?>">
                    <img src="img/movies/<?php echo $recommend_movie['slug']; ?>.jpg" alt="<?php echo $recommend_movie['name']; ?>">
                  </a>
                </figure>
                <div class="caption">
                  <a href="movie.php?id=<?php echo $recommend_movie['id']; ?>"><?php echo $recommend_movie['name']; ?></a>
                </div>
              </div>
            </article>
          <?php } ?>

        </div>
      <?php endif; ?>
      </div>
    </div>
    <!-- End Main Content -->

<?php include 'scripts/footer.php'; ?>

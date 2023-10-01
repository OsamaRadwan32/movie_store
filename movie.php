<?php
  $headerClass = 'catalog-header';
  $bodyClass = '';

  include 'scripts/connection.php';

  try {

    $movie_id = $_GET['id'];
    $sql = "SELECT * FROM $dbname.movies WHERE id = $movie_id";
    $qry = $db->query($sql);
    $results = $qry->fetch(PDO::FETCH_ASSOC);


  } catch (Exception $e) {
    echo $e->getMessage();
  }

  $pageTitle = $results['name'];

  include 'scripts/header.php';

    if (isset($_SESSION['id'])) {
      $user_id = $_SESSION['id'];
      $rating_sql = "SELECT Count(*) FROM $dbname.user_rating WHERE user_id = '$user_id' and movie_id = '$movie_id'";
      $rating_value = $db->query($rating_sql)->fetchColumn();
    } else {
      $rating_value = 0;
    }
    
 ?>

  <!-- Book container -->
  <div class="book-container">
    <div class="container clearfix">
      <div class="grid-20">
        <figure>
          <img src="img/movies/<?php echo $results['slug']; ?>.jpg" alt="<?php echo $results['name']; ?>">
        </figure>
        <div class="caption">
          <?php
          if (!isset($_SESSION['email'])) {
            echo "<p>You should log in before you buy</p>";
            echo "<a href=\"#reserve\" class=\"reserve-btn no-reserve\">Buy Movie</a>";
          } else {
            echo "<a href=\"#reserve\" class=\"reserve-btn can-reserve\">Buy Movie</a>";
          }
          ?>
          <?php if ($rating_value == 0 && isset($_SESSION['id'])) : ?>
          <form class="rating" id="ratingstars">
            <label>
              <input type="radio" name="stars" value="1" data-movie="<?php echo $movie_id; ?>"/>
              <span class="icon">★</span>
            </label>
            <label>
              <input type="radio" name="stars" value="2" data-movie="<?php echo $movie_id; ?>"/>
              <span class="icon">★</span>
              <span class="icon">★</span>
            </label>
            <label>
              <input type="radio" name="stars" value="3" data-movie="<?php echo $movie_id; ?>"/>
              <span class="icon">★</span>
              <span class="icon">★</span>
              <span class="icon">★</span>   
            </label>
            <label>
              <input type="radio" name="stars" value="4" data-movie="<?php echo $movie_id; ?>"/>
              <span class="icon">★</span>
              <span class="icon">★</span>
              <span class="icon">★</span>
              <span class="icon">★</span>
            </label>
            <label>
              <input type="radio" name="stars" value="5" data-movie="<?php echo $movie_id; ?>"/>
              <span class="icon">★</span>
              <span class="icon">★</span>
              <span class="icon">★</span>
              <span class="icon">★</span>
              <span class="icon">★</span>
            </label>
          </form>
          <?php endif; ?>
          <span id="rating_value" style="display: block; margin-top: 10px; text-align: center;"></span>
        </div>
      </div>
      <div class="grid-75">
        <div class="book-title">
          <h2><?php echo $results['name']; ?></h2>
        </div>
        <?php 
          $sql_r = "SELECT AVG(rating) as avg FROM $dbname.user_rating WHERE movie_id = $movie_id";
          $rating_value = $db->query($sql_r)->fetchColumn();
        ?>
        <div>
            <?php
              try {

                $movie_id = $_GET['id'];

                $sql = "SELECT g.name FROM $dbname.genre as g, $dbname.genre_movie as gm WHERE gm.movie_id = $movie_id and g.id = gm.genre_id";
                $qry = $db->query($sql);
                $genres = $qry->fetchAll(PDO::FETCH_ASSOC);

              } catch (Exception $e) {
                echo $e->getMessage();
              }
           ?>
          <p>Released: <b><?php echo $results['release_year']; ?></b></p>
            <p>Genre: 
          <?php foreach ($genres as $genre) { ?>
            <span class="genre"><?php echo $genre['name']; ?>, </span>
          <?php } ?>
            </p>
              <p>Rating: <b><?php echo $rating_value == null ? 0 : $rating_value ?> / 5</b></p>
          <p>Price: <b>$<?php echo $results['price']; ?></b></p>
        </div>
        <div class="mt-50">
          <h3>About the Movie</h3>
          <p class="description"><?php if ($results['description'] == '') echo "No description"; else echo $results['description']; ?></p>
        </div>
        <div class="mt-50">
          <h3>Story Line</h3>
          <span><?php echo $results['story_line'] ?></span>
        </div>
      </div>
    </div>
  </div>
    <!-- End Book container -->

    <!-- Modal window for reserving a book -->
    <div class="modal-window">
      <div class="modal-window-container" style="height: 200px;">
        <span class="close" title="Close">&times;</span>
        <div class="pickup">
          <p>Delivery Address: <span id="errorAdd">Field is empty!</span></p>
          <input type="textarea" name="address" required style="width: 100%; height: 80px;">
          <input type="submit" value="Submit" id="sbmtReserve" data-id="<?php echo $results['id']; ?>" data-price="<?php echo $results['price']; ?>" style="margin-top: 20px">
        </div>
      </div>
    </div>
    <!-- End modal window -->

<?php include 'scripts/footer.php'; ?>

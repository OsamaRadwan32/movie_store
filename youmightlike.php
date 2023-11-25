<?php
$pageTitle = 'You Might Like';
$headerClass = 'catalog-header';
$bodyClass = '';
include 'scripts/header.php';
require_once 'scripts/recommend.php';

require_once 'scripts/connection.php';

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
// print_r($matrix);

$array = getRecommendation($matrix, $_SESSION['email']);
// foreach ($array as $key => $value) {
//   echo $key . '-' . $value . '<br>';
// }
?>

<!-- Panel -->
<div class="main-content catalog-backgrnd">
  <div class="container">
    <div>
      <h2 class="topic-title">Recommended For You</h2>
    </div>
  </div>
</div>
<!-- End Panel -->

<!-- Catalogs -->
<div class="catalog-articles-container">
  <div class="container">
    <div class="loader"></div>
    <div class="row" id="article-wrapper">
      <?php
      foreach ($array as $key => $value) {
        $recommend_movie_sql = "SELECT * FROM $dbname.movies WHERE name = '$key'";
        $recommend_movie_query = $db->query($recommend_movie_sql);
        $recommend_movie = $recommend_movie_query->fetch(PDO::FETCH_ASSOC);
      ?>
        <article class="col-2 clearfix">
          <div class="article-padding">
            <div>
              <figure class="thumb">
                <a href="movie.php?id=<?php echo $recommend_movie['id']; ?>">
                  <img src="img/movies/<?php echo $recommend_movie['slug']; ?>.jpg" alt="<?php echo $recommend_movie['name']; ?>">
                </a>
              </figure>
            </div>
            <div class="breif-description caption">
              <a href="movie.php?id=<?php echo $recommend_movie['id']; ?>"><?php echo $recommend_movie['name']; ?></a>
              <p class="title"> <strong>Release Year:</strong> <?php echo $recommend_movie['release_year']; ?></p>
              <?php
              try {
                $movie_id = $recommend_movie['id'];
                $sql_g = "SELECT g.name FROM $dbname.genre as g, $dbname.genre_movie as gm WHERE gm.movie_id = $movie_id and g.id = gm.genre_id";
                $qry_g = $db->query($sql_g);
                $genres = $qry_g->fetchAll(PDO::FETCH_ASSOC);
              } catch (Exception $e) {
                echo $e->getMessage();
              }
              ?>
              <p class="title"><strong>Genre: </strong>
                <?php foreach ($genres as $genre) {
                  echo $genre['name'] . ', ';
                } ?>
              </p>
              <?php
              $sql_r = "SELECT AVG(rating) as avg FROM $dbname.user_rating WHERE movie_id = $movie_id";
              $rating_value = $db->query($sql_r)->fetchColumn();
              ?>
              <p class="title"><strong>Rating: </strong><?php echo $rating_value == null ? 0 : $rating_value; ?></p>
              <p class="title"><strong>Price: </strong>$<?php echo $recommend_movie['price']; ?></p>
              <a href="movie.php?id=<?php echo $recommend_movie['id']; ?>" class="reserve-btn">View more</a>
            </div>
          </div>
        </article>
      <?php } ?>
    </div>
  </div>
</div>
<!-- End Catalog -->

<!-- Pagination -->
<div class="pagination-container">
  <div class="container">

  </div>
</div>
<!-- End Pagination -->

<?php include 'scripts/footer.php'; ?>
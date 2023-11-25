<?php
$pageTitle = 'All Movies';
$headerClass = 'catalog-header';
$bodyClass = '';
include 'scripts/header.php';

require_once 'scripts/connection.php';

if (isset($_GET['category'])) {
  $category = $_GET['category'];
  if ($category == 'all') {
    $stmt = "SELECT * FROM $dbname.movies ORDER BY reg_date DESC";
  } else {
    $stmt = "SELECT * FROM $dbname.movies as m, $dbname.genre_movie as gm WHERE m.id = gm.movie_id and gm.genre_id = $category ORDER BY reg_date DESC";
  }

  $qry = $db->prepare($stmt);
  $qry->execute();
  $result = $qry->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!-- Panel -->
<div class="main-content catalog-backgrnd">
  <div class="container">
    <div>
      <h2 class="topic-title">Movies Catalog</h2>
    </div>
    <div class="panel">
      <div class="search-conatiner">
        <form class="search-form clearfix" method="get" id="search-catalog">
          <div class="search-input">
            <input type="text" name="search" placeholder="Explore the catalog ..." autocomplete="off">
          </div>
          <div class="search-select">
            <select name="select_option">
              <option value="name">Name</option>
              <option value="release_year">Release Year</option>
            </select>
          </div>
          <div class="search-btn-container">
            <label for="search-btn" class="search-btn-label"><i class="fa fa-search" aria-hidden="true"></i></label>
            <input type="submit" value="Search" id="search-btn" class="search-btn">
          </div>
        </form>
      </div>
      <div class="sort-container clearfix">
        <div>
          <p>View Movies as:</p>
        </div>
        <div class="sort-select">
          <select name="sort_option">
            <option value="name">Name</option>
            <option value="reg_date">Newest Releases</option>
            <option value="release_year">Release Year</option>
          </select>
        </div>

        <div>
          <p>Sort:</p>
        </div>
        <div class="sort-select">
          <select name="order">
            <option value="ASC">Ascending</option>
            <option value="DESC">Descending</option>
          </select>
        </div>
      </div>
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
      if (isset($_GET['category'])) {
        foreach ($result as $row) {
      ?>
          <article class="col-2 clearfix">
            <div class="article-padding">
              <div>
                <figure class="thumb">
                  <a href="movie.php?id=<?php echo $row['id']; ?>">
                    <img src="img/movies/<?php echo $row['slug']; ?>.jpg" alt="<?php echo $row['name']; ?>">
                  </a>
                </figure>
              </div>
              <div class="breif-description caption">
                <a href="movie.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a>
                <p class="title"> <strong>Release Year:</strong> <?php echo $row['release_year']; ?></p>
                <?php
                try {
                  $movie_id = $row['id'];
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
                <p class="title"><strong>Price: </strong>$<?php echo $row['price']; ?></p>
                <a href="movie.php?id=<?php echo $row['id']; ?>" class="reserve-btn">View more</a>
              </div>
            </div>
          </article>
      <?php }
      } ?>
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

<?php
try {
  $sqlc = "SELECT * FROM $dbname.genre";
  $qryc = $db->query($sqlc);
  $categories = $qryc->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
  echo $e->getMessage();
}
?>
<!-- Categories -->
<div class="categories-container">
  <ul class="categories-list">
    <li>
      <a href="catalog.php?category=all">All Categories</a>
    </li>
    <?php foreach ($categories as $category) { ?>
      <li>
        <a href="catalog.php?category=<?php echo $category['id'] ?>"><?php echo $category['name']; ?></a>
      </li>
    <?php } ?>
  </ul>
</div>
<!-- End Categories -->

<?php include 'scripts/footer.php'; ?>
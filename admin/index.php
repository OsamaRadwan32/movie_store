<?php
session_start();
if (isset($_SESSION['email'])) {
  if ($_SESSION['role'] == 0) {
    $pageTitle = 'Admin';
    $type = 'Admin';
  }

  $pageTitle = 'View Users';

  include 'scripts/header.php';
?>

<?php
  include '../scripts/connection.php';
  try {

    $sql = "SELECT * FROM $dbname.orders INNER JOIN $dbname.users ON orders.user_id = users.id INNER JOIN $dbname.movies ON orders.movie_id= movies.id ORDER BY orders.order_date DESC LIMIT 5";

    $qry = $db->prepare($sql);
    $qry->execute();
    $results = $qry->fetchAll(PDO::FETCH_ASSOC);

  } catch (Exception $e) {
    echo $e->getMessage();
  }

 ?>

      <div class="main-container">
        <div class="navbar fixed">
          <div class="inner-container">
            <div class="navbar-header">
              <ul>
                <li><a href="#">The Movie Store</a></li>
                <li class="active">Dashboard</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="maincontent">
          <div class="dashboard p-l-r-20 clearfix">
            <div class="card req-card">
              <div class="card-header p-20">
                <div class="card-title">New reserves</div>
                <div class="card-subtitle">Last 5 movie orders</div>
              </div>
              <div class="card-content p-l-r-20">
                <ul class="list-title size-13 clearfix">
                  <li>Movie</li>
                  <li>Client</li>
                  <li>Price</li>
                  <li>Order Date</li>
                  <li>Address</li>
                </ul>
                <ul class="list size-13">
                  <?php foreach ($results as $row) { ?>
                  <li class="p-t-b-20 clearfix">
                    <div><?php echo $row['name']; ?></div>
                    <div><?php echo $row['firstname'] . " " . $row['lastname'] ?></div>
                    <div><?php echo $row['price']; ?></div>
                    <div><?php echo $row['order_date']; ?></div>
                    <div><?php echo $row['address']; ?></div>
                  </li>
                  <?php } ?>
                </ul>
              </div>
            </div>

          </div>
        </div>
      </div>
    </main>

    <script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../js/javascript.js"></script>
  </body>
</html>

<?php
  } else {
    header ('Location: http://localhost');
  }

 ?>

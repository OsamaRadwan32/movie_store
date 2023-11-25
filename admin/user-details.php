<?php
session_start();
if (isset($_SESSION['email'])) {
  if ($_SESSION['role'] == 0) {
    $pageTitle = 'Admin';
    $type = 'Admin';
  }

  require_once '../scripts/connection.php';

  try {

    if (isset($_GET['userid'])) {
      $user_id = $_GET['userid'];
      $sql = "SELECT * FROM $dbname.users WHERE id = $user_id";
      $qry = $db->query($sql);
      $results = $qry->fetch(PDO::FETCH_ASSOC);
    }
  } catch (Exception $e) {
    echo $e->getMessage();
  }

  $pageTitle = $results['firstname'] . " " . $results['lastname'];
  include 'scripts/header.php';

?>

  <div class="main-container">
    <div class="navbar fixed">
      <div class="inner-container">
        <div class="navbar-header">
          <ul>
            <li><a href="#">The Movie Store</a></li>
            <li class="active">Users</li>
            <li class="active">View Users</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="maincontent">
      <div class="p-20 clearfix">
        <h4><i class="zmdi zmdi-accounts"></i><span>View user info</span></h4>
      </div>
      <div class="p-l-r-20 clearfix">
        <div class="card user_card">
          <div class="card-header p-20">
            <div class="card-title"><b><?php echo $results['firstname'] . " " . $results['lastname']; ?></b></div>
          </div>
          <div class="card-content">
            <div class="p-20">
              <div class="data-item clearfix">
                <div class="grid-30">Email</div>
                <div class="grid-70"><?php echo $results['email']; ?></div>
              </div>
              <div class="data-item clearfix">
                <div class="grid-30">Gender</div>
                <div class="grid-70"><?php if ($results['gender'] == 'M') echo "Male";
                                      else echo "Female"; ?></div>
              </div>
              <div class="data-item clearfix">
                <div class="grid-30">Date of Birth</div>
                <div class="grid-70"><?php $time = strtotime($results['date_of_birth']);
                                      echo date("d F, Y", $time); ?></div>
              </div>
              <div class="data-item clearfix">
                <div class="grid-30">User type</div>
                <div class="grid-70">
                  <?php
                  if ($results['role'] == 0) {
                    echo "Admin";
                  } else if ($results['role'] == 1) {
                    echo "user";
                  }
                  ?>
                </div>
              </div>
              <div class="p-t-b-20">
                <a href="update-user.php?userid=<?php echo $results['id']; ?>" class="btn update-profile-btn">Edit profile</a>
              </div>
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
  header('Location: http://localhost/TheMovieStore');
}

  ?>
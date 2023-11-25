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

    $sql = "SELECT count(*) FROM $dbname.users";
    $users_count = $db->query($sql)->fetchColumn();

    $sql = "SELECT id, CONCAT(firstname, ' ' ,lastname) AS name, email, gender, date_of_birth, role FROM $dbname.users ORDER BY role, id";
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
            <li class="active">Users</li>
            <li class="active">View Users</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="maincontent">
      <div class="p-20 clearfix">
        <h4><i class="zmdi zmdi-accounts"></i><span>View all users</span></h4>
      </div>
      <div class="p-l-r-20 clearfix">
        <div class="card book-card">
          <div class="card-header p-20">
            <div class="actions">
              <div class="search-book">
                <span class="search-icon"><i class="zmdi zmdi-search"></i></span>
                <input id="book-search-input" type="text" placeholder="Search by name">
              </div>
              <div>
                <a href="add-user.php" class="btn-icon"><i class="zmdi zmdi-plus"></i></a>
              </div>
            </div>
            <div class="card-title">View Users</div>
            <div class="card-subtitle">Overview of all users - <?php echo $users_count; ?> records</div>
          </div>
          <div>
            <table class="table">
              <thead>
                <tr>
                  <th>User ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Gender</th>
                  <th>Birth Date</th>
                  <th>User Type</th>
                </tr>
              </thead>
              <tbody id="users_tbody">
                <?php foreach ($results as $row) { ?>
                  <tr>
                    <td><a href="user-details.php?userid=<?php echo $row['id']; ?>"><?php echo $row['id']; ?></a></td>
                    <td><a href="user-details.php?userid=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></td>
                    <td><a href="user-details.php?userid=<?php echo $row['id']; ?>"><?php echo $row['email']; ?></a></td>
                    <td><a href="user-details.php?userid=<?php echo $row['id']; ?>"><?php echo $row['gender']; ?></a></td>
                    <td><a href="user-details.php?userid=<?php echo $row['id']; ?>"><?php echo $row['date_of_birth']; ?></a></td>
                    <td><a href="user-details.php?userid=<?php echo $row['id']; ?>"><?php echo $row['role'] == 0 ? 'Admin' : 'User'; ?></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  </main>

  <div class="modal-window delete-modal">
    <div class="inner-modal">
      <div class="red-banner p-20">
        <p>Are you sure you want to delete <span></span>?</p>
      </div>
      <div class="action-btn clearfix">
        <button name="yes">YES</button>
        <button name="no">NO</button>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="../js/javascript.js"></script>
  </body>

  </html>

<?php
} else {
  header('Location: http://localhost/TheMovieStore');
}

?>
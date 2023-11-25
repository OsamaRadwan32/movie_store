<?php
session_start();
if (isset($_SESSION['email'])) {
  if ($_SESSION['role'] == 0) {
    $pageTitle = 'Admin';
    $type = 'Admin';
  }

  $pageTitle = 'Add User';

  require_once '../scripts/connection.php';
  include 'scripts/header.php';
?>

  <div class="main-container">
    <div class="navbar fixed">
      <div class="inner-container">
        <div class="navbar-header">
          <ul>
            <li><a href="#">The Movie Store</a></li>
            <li class="active">Users</li>
            <li class="active">Add User</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="maincontent">
      <div class="p-20 clearfix">
        <h4><i class="zmdi zmdi-account-add"></i><span>Add Genre</span></h4>
      </div>
      <div class="p-l-r-20 clearfix">
        <div class="card add-user-card">
          <div class="card-header p-20">
            <div class="card-title">Add Genre</div>
            <div class="card-subtitle">Add a new genre to the system</div>
          </div>
          <div class="card-content p-20">
            <form class="form-floating" action="" method="post" id="add_genre_form">
              <div id="errorAdd">Please enter the required fields</div>
              <div id="insertSuccessful">Genre added successfully!</div>
              <div id="insertfail">Error adding the genre!</div>
              <div class="form-group">
                <label class="control-label">Genre *</label>
                <input type="text" name="genre" class="form-control" required>
              </div>
              <div class="form-group">
                <button type="submit" class="btn" id="add_genre">Add</button>
              </div>
            </form>
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
  header('Location: http://localhost');
}

?>
<?php
session_start();
if (isset($_SESSION['email'])) {
  if ($_SESSION['role'] == 0) {
    $pageTitle = 'Admin';
    $type = 'Admin';
  }

  $pageTitle = 'Add Movie';

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
            <h4><i class="zmdi zmdi-account-add"></i><span>Add Movie</span></h4>
          </div>
          <div class="p-l-r-20 clearfix">
            <div class="card add-user-card">
              <div class="card-header p-20">
                <div class="card-title">Add Movie</div>
                <div class="card-subtitle">Add a new movie to the system</div>
              </div>
              <div class="card-content p-20">
                <form class="form-floating" action="" method="post" id="add_movie_form">
                  <div id="errorAdd">Please enter the required fields</div>
                  <div id="insertSuccessful">Movie added successfully!</div>
                  <div id="insertfail">Error adding the Movie!</div>
                  <div class="form-group">                  </div>
                  <div class="form-group">
                    <label class="control-label">Movie Name *</label>
                    <input type="text" name="movie_name" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Slug *</label>
                    <input type="text" name="slug" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Description *</label>
                    <input type="text" name="description"class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label active">Story Line *</label>
                    <input type="text" name="story_line" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label active ac">Release Year *</label>
                    <input type="text" name="release_year" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label active">Price *</label>
                    <input type="text" name="price" class="form-control">
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn" id="add_movie">Add</button>
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
    header ('Location: http://localhost');
  }

 ?>

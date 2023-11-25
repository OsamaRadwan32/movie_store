<?php
session_start();
if (isset($_SESSION['email'])) {
  if ($_SESSION['role'] == 0) {
    $pageTitle = 'Admin';
    $type = 'Admin';
  }

  $pageTitle = 'Profile';

  include 'scripts/header.php';
?>

  <div class="main-container">
    <div class="navbar fixed">
      <div class="inner-container">
        <div class="navbar-header">
          <ul>
            <li><a href="#">The Movie Store</a></li>
            <li class="active">Profile</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="maincontent">
      <div class="p-20 clearfix">
        <h4><i class="zmdi zmdi-account-box-o"></i><span>My Profile</span></h4>
      </div>
      <div class="p-l-r-20 clearfix">
        <div class="card profile-card" id="admin_profile_card">
          <div class="card-header p-20">
            <div class="card-title"><?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?></div>
          </div>
          <div class="card-content">
            <div class="p-20">
              <div class="data-item clearfix">
                <div class="grid-30">Email</div>
                <div class="grid-70"><?php echo $_SESSION['email']; ?></div>
              </div>
              <div class="data-item clearfix">
                <div class="grid-30">Password</div>
                <div class="grid-70">&#8226; &#8226; &#8226; &#8226; &#8226; &#8226; &#8226; &#8226;</div>
              </div>
              <div class="data-item clearfix">
                <div class="grid-30">Gender</div>
                <div class="grid-70"><?php echo $_SESSION['gender'] ?></div>
              </div>
              <div class="data-item clearfix">
                <div class="grid-30">Date of Birth</div>
                <div class="grid-70"><?php echo $_SESSION['date_of_birth'] ?></div>
              </div>
              <div class="p-t-b-20">
                <button name="button" class="btn update-profile-btn">Edit Password</button>
              </div>
            </div>
          </div>
        </div>

        <div class="card profile-card" id="edit_admin_card">
          <div class="card-header p-20">
            <div class="card-title"><?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?></div>
            <div class="card-subtitle">Edit Profile</div>
          </div>
          <div class="card-content">
            <div class="p-20">
              <form class="form-floating" method="post" id="edit_admin_profile">
                <div id="errorAdd">Password field is empty!</div>
                <div id="insertSuccessful">Updated Successfully!</div>
                <div id="insertfail">Error Updating!</div>
                <div class="form-group">
                  <label class="control-label">Password</label>
                  <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn" id="update_admin_btn">Update</button>
                </div>
              </form>
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
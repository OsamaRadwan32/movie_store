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
        <h4><i class="zmdi zmdi-account-add"></i><span>Add User</span></h4>
      </div>
      <div class="p-l-r-20 clearfix">
        <div class="card add-user-card">
          <div class="card-header p-20">
            <div class="card-title">Add User</div>
            <div class="card-subtitle">Add a new user to the system</div>
          </div>
          <div class="card-content p-20">
            <form class="form-floating" action="" method="post" id="add_user_form">
              <div id="errorAdd">Please enter the required fields</div>
              <div id="insertSuccessful">User added successfully!</div>
              <div id="insertfail">Error adding the user!</div>
              <div class="form-group">
                <p>ID for the new user: <span id="newID"></span></p>
              </div>
              <div class="form-group">
                <label class="control-label">First Name *</label>
                <input type="text" name="fname" class="form-control" required>
              </div>
              <div class="form-group">
                <label class="control-label">Last Name *</label>
                <input type="text" name="lname" class="form-control" required>
              </div>
              <div class="form-group">
                <label class="control-label">Email *</label>
                <input type="email" name="user_email" class="form-control" required>
              </div>
              <div class="form-group">
                <label class="control-label active">Gender *</label>
                <select class="form-control" name="gender" required>
                  <option value="Female">Female</option>
                  <option value="Male">Male</option>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label active ac">Birth Date</label>
                <input type="date" name="dob" class="form-control" required>
              </div>
              <div class="form-group">
                <label class="control-label active">Type *</label>
                <select class="form-control" name="type" required>
                  <option value="0">Admin</option>
                  <option value="1">User</option>
                </select>
              </div>
              <?php
              try {
                $sql = "SELECT * FROM $dbname.country";
                $qry = $db->query($sql);
                $countries = $qry->fetchAll(PDO::FETCH_ASSOC);
              } catch (Exception $e) {
                echo $e->getMessage();
              }
              ?>
              <div class="form-group">
                <label class="control-label active">Country *</label>
                <select class="form-control" name="country" required>
                  <?php foreach ($countries as $country) { ?>
                    <option value="<?php echo $country['id'] ?>"><?php echo $country['country'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <button type="submit" class="btn" id="add_user">Add</button>
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
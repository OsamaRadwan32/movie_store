<?php
session_start();
if (isset($_SESSION['email'])) {
  if ($_SESSION['role'] == 0) {
    $pageTitle = 'Admin';
    $type = 'Admin';
  }

  $pageTitle = 'Update Book';

  include 'scripts/header.php';
?>

  <?php
  include '../scripts/connection.php';

  $userid = $_GET['userid'];

  try {

    $sql = "SELECT fname, lname FROM library.user WHERE user_id = $userid";
    $qry = $db->query($sql);
    $row = $qry->fetch(PDO::FETCH_ASSOC);
  } catch (Exception $e) {
    echo $e->getMessage();
  }

  ?>
  <div class="main-container">
    <div class="navbar fixed">
      <div class="inner-container">
        <div class="navbar-header">
          <ul>
            <li><a href="#">A&amp;M library</a></li>
            <li class="active">Users</li>
            <li class="active">Edit User</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="maincontent">
      <div class="p-20 clearfix">
        <h4><i class="zmdi zmdi-book-image"></i><span>Edit user</span></h4>
      </div>
      <div class="p-l-r-20 clearfix">
        <div class="card update-card">
          <div class="card-header p-20">
            <div class="card-title">Edit <strong><?php echo $row['fname'] . " " . $row['lname']; ?></strong> Profile.</div>
          </div>
          <div class="card-content">
            <div class="p-20">
              <div id="errorAdd">Please fill the field</div>
              <div id="insertSuccessful">Updated Successfully!</div>
              <div id="insertfail">Error updating!</div>
              <p>Select what to update</p>
              <select class="form-control" name="update" id="selectupdateuser">
                <option value="select">Select</option>
                <?php if ($_SESSION['permission'] == 'A') { ?>
                  <option value="permission">Permission</option>
                <?php } ?>
                <option value="password">Password</option>
              </select>
              <?php if ($_SESSION['permission'] == 'A') { ?>
                <div class="form-group" id="userType">
                  <select class="form-control" name="usertype">
                    <option value="select">Select</option>
                    <option value="A">Admin</option>
                    <option value="L">Librarian</option>
                    <option value="P">Professor</option>
                    <option value="S">Student</option>
                  </select>
                </div>
              <?php } ?>
              <div class="form-group">
                <input type="password" name="userupdatepass" class="form-control" id="userupdatepass">
              </div>
              <div class="form-group">
                <button type="submit" class="btn" id="edit_profile">Update</button>
              </div>
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
  header('Location: http://localhost');
}

?>
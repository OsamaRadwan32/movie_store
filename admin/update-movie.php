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

  $isbn = $_GET['isbn'];

  try {

    $sql = "SELECT title FROM library.books WHERE isbn = '$isbn'";
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
                <li><a href="#">The Movie Store</a></li>
                <li class="active">Movies</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="maincontent">
          <div class="p-20 clearfix">
            <h4><i class="zmdi zmdi-book-image"></i><span>Update book</span></h4>
          </div>
          <div class="p-l-r-20 clearfix">
            <div class="card update-card">
              <div class="card-header p-20">
                <div class="card-title">Update <strong><?php echo $row['title']; ?></strong> book.</div>
              </div>
              <div class="card-content">
                <div class="p-20">
                  <div id="errorAdd">Please fill the field</div>
                  <div id="insertSuccessful">Updated Successfully!</div>
                  <div id="insertfail">Error updating!</div>
                  <p>Select what to update</p>
                  <select class="form-control" name="update">
                    <option value="select">Select</option>
                    <option value="isbn">ISBN</option>
                    <option value="title">Title</option>
                    <option value="genre">Genre</option>
                    <option value="lang">Language</option>
                    <option value="img">Image Name</option>
                    <option value="description">Description</option>
                    <option value="qty">Quantity</option>
                    <option value="year">Year Published</option>
                    <option value="publisher">Publisher</option>
                    <option value="price">Price</option>
                  </select>
                  <div class="form-group">
                    <input type="text" class="form-control">
                  </div>
                  <div class="form-group">
                    <textarea rows="4" class="form-control vertial"></textarea>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn" id="update_book">Update</button>
                  </div>
                </div>
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
    header ('Location: http://localhost');
  }
 ?>

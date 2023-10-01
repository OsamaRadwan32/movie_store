<?php
  $pageTitle = 'Your Profile';
  $headerClass = 'catalog-header';
  $bodyClass = '';
  include 'scripts/header.php';
 ?>

    <!-- User Profile Info -->
    <div class="useraccount">
      <div class="container">
        <h2>Profile Info</h2>
        <div class="info">
          <dl>
            <div class="data-item clearfix">
              <dt class="col-4"><strong>First Name</strong></dt>
              <dd class="grid-75"><?php echo $_SESSION['firstname']; ?></dd>
            </div>
          </dl>
          <dl>
            <div class="data-item clearfix">
              <dt class="col-4"><strong>Last Name</strong></dt>
              <dd class="grid-75"><?php echo $_SESSION['lastname']; ?></dd>
            </div>
          </dl>
          <dl>
            <div class="data-item clearfix">
              <dt class="col-4"><strong>Email Address</strong></dt>
              <dd class="grid-75"><?php echo $_SESSION['email']; ?></dd>
            </div>
          </dl>
          <dl>
            <div class="data-item clearfix">
              <dt class="col-4"><strong>Password</strong></dt>
              <dd class="grid-75">&#8226; &#8226; &#8226; &#8226; &#8226; &#8226; &#8226; &#8226;<span class="edit"><a href="password.php" title="Change Password"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></span></dd>
            </div>
          </dl>
          <dl>
            <div class="data-item clearfix">
              <dt class="col-4"><strong>Gender</strong></dt>
              <dd class="grid-75"><?php echo $_SESSION['gender'] ?></dd>
            </div>
          </dl>
          <dl>
            <div class="data-item clearfix">
              <dt class="col-4"><strong>Date of Birth</strong></dt>
              <dd class="grid-75">
                <?php
                  if ($_SESSION['date_of_birth'] == "0000-00-00") {
                    echo "N/A";
                  } else {
                    $time = strtotime($_SESSION['date_of_birth']);
                    echo date("d F, Y", $time);
                  }
                 ?>
              </dd>
            </div>
          </dl>
        </div>
      </div>
    <!-- End User Profile Info -->

<?php include 'scripts/footer.php'; ?>

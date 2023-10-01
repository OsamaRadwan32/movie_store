<?php
  $pageTitle = 'Change Password';
  $headerClass = 'catalog-header';
  $bodyClass = '';
  include 'scripts/header.php';
 ?>

    <!-- Change password container -->
    <div class="useraccount">
      <div class="container">
        <div class="info password">
          <h2>Change Password</h2>
          <div class="change_password">
            <form class="" action="" method="post">
              <div class="data-item">
                <label for="password">New Password: </label>
                <input type="password" name="change_password_field" id="password">
              </div>
              <input type="submit" name="change_password_btn" value="Change Password" class="passwordBtn" id="change_password" disabled>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- End change password container -->

<?php include 'scripts/footer.php'; ?>

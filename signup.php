<?php
  $pageTitle = 'Sign Up';
  $headerClass = 'catalog-header';
  $bodyClass = '';
  include 'scripts/header.php';
 ?>

    <!-- Change password container -->
    <div class="useraccount">
      <div class="container">
        <div class="info password">
          <h2>Sign Up</h2>
          <div class="change_password signup">
            <form class="" action="scripts/signup.php" method="post">
              <div class="data-item">
                <label for="password">First Name: </label>
                <input type="text" name="fname" id="password">
              </div>
              <div class="data-item">
                <label for="password">Last Name: </label>
                <input type="text" name="lname" id="password">
              </div>
              <div class="data-item">
                <label for="password">Gender: </label>
                <select class="select_input" name="gender">
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
              <div class="data-item">
                <label for="password">Email: </label>
                <input type="email" name="user_email" id="password">
              </div>
              <div class="data-item">
                <label for="password">Password: </label>
                <input type="password" name="password" id="password">
              </div>
              <input type="submit" name="change_password_btn" value="Signup" class="passwordBtn" id="Signup" disabled>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- End change password container -->

<?php include 'scripts/footer.php'; ?>

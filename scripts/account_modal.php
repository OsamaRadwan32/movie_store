<li class="account">
  <a id="accountBtn"><i class="fa fa-user" aria-hidden="true"></i><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?></a>
  <div class="account-window">
    <a href="profile.php">View Profile</a>
    <a href="#logout" id="logout">Sign out</a>
  </div>
</li>
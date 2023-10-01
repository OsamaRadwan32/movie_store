<?php
  include 'scripts/connection.php';
  @session_start();
 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo $pageTitle; ?></title>
  <link href="https://fonts.googleapis.com/css?family=Lora:400,700,700i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Italianno" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700" rel="stylesheet">
  <link rel="icon" type="image/png" href="../img/favicon/favicon.png">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body <?php echo "class=\"$bodyClass\""; ?>>
  <header <?php echo "class=\"$headerClass\""; ?>>
    <div class="main-header">
      <div class="top-header">
        <div class="container">
          <div class="brand">
            <h1 class="brand-name"><a href="./">The Movie Store</a></h1>
          </div>
          <nav class="nav">
            <ul>
              <li><a href="./">Home</a></li>
              <?php 
              if (isset($_SESSION['id'])) {
                  $login_user_id = $_SESSION['id'];
                  $user_rating_exist_sql = "SELECT * FROM $dbname.user_rating WHERE user_id = $login_user_id";
                  $user_rating_exist_qry = $db->prepare($user_rating_exist_sql);
                  $user_rating_exist_qry->execute();
              }
              

              if (isset($_SESSION['email']) && $user_rating_exist_qry->rowCount() > 0) : ?>
              <li><a href="youmightlike.php?category=all">You Might Like</a></li>
            <?php endif; ?>
              <li><a href="catalog.php?category=all">All Movies</a></li>
              <?php
              if (!isset($_SESSION['email'])) {
                include 'scripts/login_modal.php';
                echo '<li><a href="signup.php">Sign Up</a></li>';
              } else {
                include 'scripts/account_modal.php';
              }
              ?>
              
        </ul>
      </nav>
    </div>
  </div>
  <?php
  if ($pageTitle == 'Home') {
    include 'bottom_header.php';
  }
  ?>
</div>
</header>
<!-- End Header -->

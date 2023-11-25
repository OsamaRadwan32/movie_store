<?php
if (isset($_SESSION['email'])) {
  if ($_SESSION['role'] != 0) {
    header('Location: http://localhost/TheMovieStore');
  } else {
?>
    <!DOCTYPE html>
    <html>

    <head>
      <meta charset="utf-8">
      <title><?php echo $pageTitle; ?></title>
      <link href="https://fonts.googleapis.com/css?family=Lora:400,700,700i" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
      <link rel="icon" type="image/png" href="../img/favicon/favicon.png">
      <link rel="stylesheet" href="../css/material-design-iconic-font.css">
      <link rel="stylesheet" href="../css/normalize.css">
      <link rel="stylesheet" href="../css/style.css">
    </head>

    <body class="admin">
      <main>
        <div class="sidebar fixed">
          <div class="brand-logo">
            <h1 class="brand-name"><a href="../">The Movie Store</a></h1>
          </div>
          <div class="user">
            <div class="content">
              <div class="user-name"><?php echo $_SESSION['firstname']; ?>
                <span class="user-type"><?php echo $type; ?></span>
              </div>
              <div class="user-email"><?php echo $_SESSION['email']; ?></div>
              <div class="user-actions">
                <a href="profile.php" title="Profile">Profile</a>
                <!-- <a href="#logout" title="Logout" id="logout">Logout</a> -->
              </div>
            </div>
          </div>
          <ul class="menu-links">
            <li><a href="index.php"><i class="zmdi zmdi-view-dashboard"></i><span class="scope">Dashboard</span></a></li>
            <li>
              <a href="#books" class="has-sublist" id="books-btn"><i class="zmdi zmdi-book"></i><span class="scope">Movies</span></a>
              <ul id="books" class="menu-links">
                <li><a href="../catalog.php?category=all">View Movies</a></li>\
                <li><a href="add-movie.php">Add Movie</a></li>
                <li><a href="add-genre.php">Add Genre</a></li>
                <!-- <li><a href="add-movie.php">Add Movie</a></li> -->
              </ul>
            </li>
            <li>
              <a href="#users" class="has-sublist" id="users-btn"><i class="zmdi zmdi-account"></i><span class="scope">Users</span></a>
              <ul id="users" class="menu-links">
                <li><a href="view-users.php">View Users</a></li>
                <li><a href="add-user.php">Add User</a></li>
              </ul>
            </li>
            <!-- <li><a href="add-genre.php"><i class="zmdi zmdi-account-add"></i><span class="scope">Add Genre</span></a></li> -->
          </ul>
        </div>
    <?php
  }
} else {
  echo "error";
}
    ?>
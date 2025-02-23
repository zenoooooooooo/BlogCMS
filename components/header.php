<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../styles/componentStyles/header.css" />
  <link href="../assets/favicon.png" rel="icon" type="image/png" />
</head>

<body>
  <header>
    <nav>
      <ul>
        <li id="dashboardLogo"><a href="./dashboard.php">BlogCMS</a></li>
        <form action="../content/dashboard.php" method="get">
          <input class="searchBar" type="text" name="search" placeholder="Search...">
          <input class="searchButton" type="submit" value="Search">
        </form>
        <li><a href="./about.php">About</a></li>
        <li><a href="./profile.php"><?php echo $_SESSION['username']; ?></a></li>
      </ul>
    </nav>
  </header>
</body>

</html>
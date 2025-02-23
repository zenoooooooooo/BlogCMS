<?php session_start() ?>
<header>
  <nav>
    <ul>
      <form action="../content/dashboard.php" method="get">
        <input class="searchBar" type="text" name="search" placeholder="Search...">
        <input class="searchButton" type="submit" value="Search">
      </form>
      <li><a href="./profile.php"><?php echo $_SESSION['username']; ?></a></li>
    </ul>
  </nav>
</header>
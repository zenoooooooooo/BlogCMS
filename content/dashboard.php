<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/dashboard.css">
    <link rel="stylesheet" href="../styles/componentStyles/header.css">
    <link rel="stylesheet" href="../styles/componentStyles/leftSection.css">
    <link rel="stylesheet" href="../styles/componentStyles/rightSection.css">
    <link rel="stylesheet" href="../styles/writeNew.css">
    <link href="../assets/favicon.png" rel="icon" type="image/png" />
    <script src="../scripts/formSubmit.js" defer></script>
    <title>Dashboard - BlogCMS</title>
</head>

<body>
    <?php
    include("../components/header.php");
    ?>
    <?php
    include("../components/leftSection.php");
    ?>
    <?php
    include("../components/rightSection.php");
    ?>
    <?php
    include("./writeNew.php");
    ?>
</body>

</html>
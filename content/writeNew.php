<?php
session_start();
require_once __DIR__ . '/../config/database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/writeNew.css">
    <link rel="stylesheet" href="../styles/componentStyles/header.css">
    <link rel="stylesheet" href="../styles/componentStyles/leftSection.css">
    <link rel="stylesheet" href="../styles/componentStyles/rightSection.css">
    <link href="../assets/favicon.png" rel="icon" type="image/png" />
    <script src="../scripts/InputManager.js" defer></script>
    <script src="../scripts/ImageUpload.js" defer></script>
    <title>Document</title>
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
    <main class="write-new">
        <h1>Write New Post</h1>
        <form action="../content/writeNew.php" method="post" enctype="multipart/form-data">

            <input class=" textInput" type="text" name="title" placeholder="Title">

            <div id="tagContainer" class="array-bubble"></div>
            <div class="container">
                <input class="textInput" type="text" id="tagInput" placeholder="Tag People">
                <button type="button" class="sideButton" onclick="tagManager.addItem()">Add</button>
            </div>
            <input type="hidden" name="tags" id="hiddenTags">

            <div id="categoryContainer" class="array-bubble"></div>
            <div class="container">
                <input class="textInput" type="text" id="categoryInput" placeholder="Categories">
                <button type="button" class="sideButton" onclick="categoryManager.addItem()">Add</button>
            </div>
            <input type="hidden" name="categories" id="hiddenCategories">

            <div class="container">
                <input class="textInput" type="text" id="imageTextInput" placeholder="Image here..." readonly>
                <button type="button" class="sideButton" id="uploadButton">Upload</button>
                <input type="file" id="fileInput" name="image" accept="image/jpeg, image/png" style="display: none;">
            </div>
            <input type="hidden" name="imageFilename" id="hiddenImageFilename">

            <textarea name="description" placeholder="Description"></textarea>
            <input class="submitButton" type="submit" name="submit" value="Submit">
            <div class="message">
                <?php


                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    $post_id = null;

                    if (!empty($_POST['title']) && !empty($_POST['description'])) {
                        $title = $_POST['title'];
                        $description = $_POST['description'];


                        if (!isset($_SESSION['user_id'])) {
                            echo "You are not logged in!";
                            exit();
                        }

                        $user_id = $_SESSION['user_id'];

                        $stmt = $connection->prepare("INSERT INTO posts (user_id, title, description) VALUES (?, ?, ?)");
                        mysqli_stmt_bind_param($stmt, "iss", $user_id, $title, $description);



                        if (mysqli_stmt_execute($stmt)) {
                            $post_id = mysqli_insert_id($connection);
                            echo "Post created successfully! Post ID: " . $post_id;
                        } else {
                            echo "Error inserting post: " . mysqli_stmt_error($stmt);
                        }

                        mysqli_stmt_close($stmt);
                    } else {
                        echo "Title and description are required.";
                    }


                    if (isset($_POST['tags'])) {
                        $tags = $_POST['tags'];
                        $tagsArray = explode(",", $tags);
                        foreach ($tagsArray as $tag) {
                            $tag = trim($tag);
                            $searchStmt = $connection->prepare("SELECT id FROM users WHERE username = ?");
                            mysqli_stmt_bind_param($searchStmt, "s", $tag);
                            mysqli_stmt_execute($searchStmt);
                            mysqli_stmt_store_result($searchStmt);

                            if (mysqli_stmt_num_rows($searchStmt) > 0) {
                                mysqli_stmt_bind_result($searchStmt, $id);
                                mysqli_stmt_fetch($searchStmt);
                                $stmt = $connection->prepare("INSERT INTO tags (post_id, user_id) VALUES (?, ?)");
                                mysqli_stmt_bind_param($stmt, "ii", $post_id, $id);
                                if (mysqli_stmt_execute($stmt)) {
                                    echo "Tag created successfully!";
                                }
                            } else {
                                echo "No users found with username: " . $tag;
                            }
                        }
                    }
                }
                ?>
            </div>
        </form>
    </main>
</body>

</html>
<?php
session_start();
?>
<main class="write-new">
    <h1>Write New Post</h1>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" enctype="multipart/form-data"
        onsubmit="categoryManager.prepareFormData(); tagManager.prepareFormData(); imageUploader.prepareFormData();">

        <input class="textInput" type="text" name="title" placeholder="Title">

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
    </form>
</main>


<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST["title"];
    $description = $_POST["description"];
    $tags = $_POST["tags"];
    $categories = $_POST["categories"];
    $imageFilename = $_POST["imageFilename"];

    $query = "INSERT INTO users(username, email, password) VALUES('$username', '$email', '$password')";
    try {
        mysqli_query($connection, $query);
        header("Location: ./login.php");
        exit();
    } catch (mysqli_sql_exception $e) {
        echo "Could not register: " . $e->getMessage();
    }
}

?>
<?php
session_start();
?>

<main class="write-new">
    <h1>Write New Post</h1>
    <form action="process.php" method="post" onsubmit="categoryManager.prepareFormData(); tagManager.prepareFormData();">
        <input class="textInput" type="text" name="title" placeholder="Title">



        <div class="container">
            <div id="tagContainer" class="array-bubble"></div>
            <input class="textInput" type="text" id="tagInput" placeholder="Tag People">
            <button type="button" onclick="tagManager.addItem()">Add Tag</button>
        </div>

        <input type="hidden" name="tags" id="hiddenTags">

        <div class="container">
            <div id="categoryContainer" class="array-bubble"></div>
            <input class="textInput" type="text" id="categoryInput" placeholder="Categories">
            <button type="button" onclick="categoryManager.addItem()">Add Category</button>
        </div>

        <input type="hidden" name="categories" id="hiddenCategories">

        <input class="submitButton" type="submit" name="submit" value="Submit">
    </form>

</main>


<?php
if (!isset($_SESSION["categories"])) {
    $_SESSION["categories"] = array();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["category"])) {
    $category = trim($_POST["category"]);
    if (!empty($category)) {
        array_push($_SESSION["categories"], $category);
    }
}

$categories = $_SESSION["categories"];
?>
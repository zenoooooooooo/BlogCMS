<?php
session_start(); // Start session to store categories

if (!isset($_SESSION["categories"])) {
    $_SESSION["categories"] = array(); // Initialize categories if not set
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["category"])) {
    $category = trim($_POST["category"]); // Remove extra spaces
    if (!empty($category)) {
        array_push($_SESSION["categories"], $category); // Store in session
    }
}

$categories = $_SESSION["categories"]; // Retrieve stored categories
?>


<main class="write-new">
    <h1>Write New Post</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">


        <input class="textInput" type="text" name="title" placeholder="Title">
        <input class="textInput" type="text" name="tagPeople" placeholder="Tag People">
        <p>
            <?php
            if (!empty($categories)) {
                echo "Categories: " . implode(", ", $categories); 
            }
            ?>
        </p>
        <input class="textInput" type="text" name="category" placeholder="Categories">
        <input class="submitButton" type="submit" name="submit" value="Submit">
    </form>


</main>
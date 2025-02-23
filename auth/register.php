<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./assets/favicon.png" rel="icon" type="image/png" />
    <title>Register - BlogCMS</title>
</head>

<body>

    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1>Register</h1>
        <input type="text" name="username" placeholder="Username">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" name="register" value="Register">
    </form>

</body>

</html>



<?php
require_once __DIR__ . '/../config/database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = password_hash(filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS), PASSWORD_DEFAULT);

    if (empty($username) || empty($password) || empty($email)) {
        echo "All fields are required";
    } else {
        $query = "INSERT INTO users(username, email , password) VALUES('$username', '$email' , '$password')";
        try {
            mysqli_query($connection, $query);
            header("Location: ./login.php");
        } catch (mysqli_sql_exception) {
            echo "Could not register...";
        }
    }
}
?>
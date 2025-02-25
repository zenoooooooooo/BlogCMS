<?php
session_start();
require_once __DIR__ . '/../config/database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./assets/favicon.png" rel="icon" type="image/png" />
    <link rel="stylesheet" href="../styles/auth.css">
    <title>Login - BlogCMS</title>
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1>Login</h1>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" name="login" value="Login">
        <div class="message">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
                $password = $_POST["password"];

                $stmt = $connection->prepare("SELECT id, username, password FROM users WHERE email = ?");
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) > 0) {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    mysqli_stmt_fetch($stmt);

                    if (password_verify($password, $hashed_password)) {
                        $_SESSION['user_id'] = $id;
                        $_SESSION['username'] = $username;
                        $_SESSION['email'] = $email;

                        header("Location: ../content/dashboard.php");
                        exit();
                    } else {
                        echo "Incorrect password!";
                    }
                } else {
                    echo "User not found!";
                }
            }
            ?>
        </div>
        <p class="changeMode-prompt">Don't have an account? <a href="./register.php">Sign up instead</a></p>
    </form>
</body>

</html>
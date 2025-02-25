<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./assets/favicon.png" rel="icon" type="image/png" />
    <link rel="stylesheet" href="../styles/auth.css">
    <title>Register - BlogCMS</title>
</head>

<body>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1>Register</h1>
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" name="register" value="Register">
        <div class="message">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                require_once __DIR__ . '/../config/database.php';

                $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
                $password = $_POST["password"];

                $usernameCheck = $connection->prepare("SELECT id FROM users WHERE username = ?");
                mysqli_stmt_bind_param($usernameCheck, "s", $username);
                mysqli_stmt_execute($usernameCheck);
                mysqli_stmt_store_result($usernameCheck);

                $emailCheck = $connection->prepare("SELECT id FROM users WHERE email = ?");
                mysqli_stmt_bind_param($emailCheck, "s", $email);
                mysqli_stmt_execute($emailCheck);
                mysqli_stmt_store_result($emailCheck);

                if (mysqli_stmt_num_rows($usernameCheck) > 0) {
                    echo "'{$username}' is already taken";
                } elseif (mysqli_stmt_num_rows($emailCheck) > 0) {
                    echo "'{$email}' already registered!";
                } else {

                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


                    $stmt = $connection->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashed_password);

                    if (mysqli_stmt_execute($stmt)) {
                        header("Location: ../auth/login.php");
                        exit();
                    } else {
                        echo "Registration failed!";
                    }
                }
            }
            ?>


        </div>
        <p class="changeMode-prompt">Already have an account? <a href="./login.php">Log in instead</a></p>
    </form>

</body>

</html>
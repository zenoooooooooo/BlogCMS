<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: ./content/dashboard.php");
    exit();
} else {
    header("Location: ./auth/login.php");
    exit();
}
?>
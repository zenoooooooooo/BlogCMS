<?php

require_once __DIR__ . '/env.php';

$db_server = getenv('DB_SERVER');
$db_user = getenv('DB_USER');
$db_password = getenv('DB_PASSWORD');
$db_name = getenv('DB_NAME');
$connection = "";

try {
    $connection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
} catch (mysqli_sql_exception) {
    throw new Exception("Database connection failed");
}

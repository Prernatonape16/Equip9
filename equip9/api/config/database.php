<?php
// Database configuration
$host = "localhost";
$db_name = "equip9"; // Your database name
$username = "root"; // Your database username
$password = ""; // Your database password

try {
    $conn = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    echo "Connection error: " . $exception->getMessage();
}
?>

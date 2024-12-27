<?php
// Include database configuration file
include_once 'C:/wamp/www/equip9/api/config/database.php';

// Get the user ID from the request (query parameter)
$userId = isset($_GET['id']) ? $_GET['id'] : die();

// Prepare the SQL query to fetch the user details
$query = "SELECT id, first_name, last_name, email, mobile, password FROM users WHERE id = :id LIMIT 1";
$stmt = $conn->prepare($query);

// Bind the ID parameter to the query
$stmt->bindParam(':id', $userId);

// Execute the query
$stmt->execute();

// Check if the user exists
if ($stmt->rowCount() > 0) {
    // Fetch the user data as an associative array
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Respond with the user data in JSON format
    echo json_encode(array(
        "user" => $user
    ));
} else {
    // Respond with an error if the user is not found
    echo json_encode(array(
        "error" => "User not found"
    ));
}
?>

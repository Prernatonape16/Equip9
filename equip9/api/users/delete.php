<?php
header("Content-Type: application/json");
include('../../config/database.php');

// Get the user_id from the URL parameters
$user_id = isset($_GET['id']) ? $_GET['id'] : die(json_encode(array("error" => "User ID is required")));

// Check if the user exists before attempting to delete
$sql_check = "SELECT id FROM users WHERE id = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("i", $user_id);
$stmt_check->execute();
$stmt_check->store_result();

// If user exists, proceed with delete
if ($stmt_check->num_rows > 0) {
    // Prepare the SQL query to delete the user
    $sql = "DELETE FROM users WHERE id = ?";
    
    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the user_id parameter to the query
        $stmt->bind_param("i", $user_id);
        
        // Execute the query
        if ($stmt->execute()) {
            echo json_encode(array("message" => "User deleted successfully"));
        } else {
            echo json_encode(array("error" => "Failed to delete user"));
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo json_encode(array("error" => "Failed to prepare the SQL statement"));
    }
} else {
    echo json_encode(array("error" => "User not found"));
}

// Close the connection
$conn->close();
?>

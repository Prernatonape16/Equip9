<?php
header("Content-Type: application/json");
include('../../config/database.php');

// Get data from the request body
$data = json_decode(file_get_contents("php://input"), true);

// Check if the required fields are set
if (isset($data['first_name'], $data['last_name'], $data['mobile'], $data['password'])) {
    $first_name = $data['first_name'];
    $last_name = $data['last_name'];
    $mobile = $data['mobile'];
    
    // Hash the password using a more secure method (bcrypt)
    $password = password_hash($data['password'], PASSWORD_BCRYPT);

    // Prepare the SQL query with placeholders
    $sql = "INSERT INTO `users`(first_name, last_name, mobile, password) VALUES (?, ?, ?, ?, ?)";

    // Prepare statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters to the query
        $stmt->bind_param("sssss", $first_name, $last_name, $mobile, $password);
        
        // Execute the query
        if ($stmt->execute()) {
            echo json_encode(array("message" => "User created successfully"));
        } else {
            echo json_encode(array("error" => "Failed to create user"));
        }

        // Close the statement
        $stmt->close();
    } else {
        echo json_encode(array("error" => "Failed to prepare the SQL statement"));
    }
} else {
    echo json_encode(array("error" => "Missing required fields"));
}

// Close the connection
$conn->close();
?>

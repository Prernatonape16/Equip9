<?php
header("Content-Type: application/json");
include('../../config/database.php');

// Get data from the request body
$data = json_decode(file_get_contents("php://input"), true);

// Check if the required fields are set
if (isset($data['id'], $data['first_name'], $data['last_name'], $data['email'], $data['mobile'], $data['password'])) {
    $id = $data['id'];
    $first_name = $data['first_name'];
    $last_name = $data['last_name'];
    $email = $data['email'];
    $mobile = $data['mobile'];
    
    // Hash the password using a secure method (bcrypt)
    $password = password_hash($data['password'], PASSWORD_BCRYPT);

    // Prepare the SQL query with placeholders
    $sql = "UPDATE users SET first_name = ?, last_name = ?, email = ?, mobile = ?, password = ? WHERE id = ?";

    // Prepare statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters to the query
        $stmt->bind_param("sssssi", $first_name, $last_name, $email, $mobile, $password, $id);

        // Execute the query
        if ($stmt->execute()) {
            echo json_encode(array("message" => "User updated successfully"));
        } else {
            echo json_encode(array("error" => "Failed to update user"));
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

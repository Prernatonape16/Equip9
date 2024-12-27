<?php
session_start(); // Start the session

if (isset($_SESSION['user_id'])) {
    // If the user is logged in, display their name
    $full_name = $_SESSION['user_first_name'] . ' ' . $_SESSION['user_last_name'];
} else {
    // If the user is not logged in, redirect to the login page
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    
    <!-- Custom CSS for styling -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f8ff;
            color: #333;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .heading {
            font-size: 2em;
            margin-bottom: 20px;
            color: #1D5D9B;
        }

        .message {
            font-size: 1.2em;
            margin-bottom: 20px;
            color: #555;
        }

        .button {
            background-color: #1D5D9B;
            color: white;
            padding: 10px 20px;
            font-size: 1em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #1D5D9B;
        }

        footer {
            margin-top: 40px;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1 class="heading">Welcome Back!</h1>
        <p class="message">Hello, <?php echo $full_name; ?>! We're glad to see you again.</p>
        <a href="dashboard.html" class="button">Go to Dashboard</a>
    </div>

    <footer>
        <p>&copy; 2024 Your Website. All Rights Reserved.</p>
    </footer>

</body>
</html>

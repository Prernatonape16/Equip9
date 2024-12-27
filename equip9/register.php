<?php

@include 'config.php';

if(isset($_POST['submit']))
{

   $filter_first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
$first_name = mysqli_real_escape_string($conn, $filter_first_name);

$filter_last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
$last_name = mysqli_real_escape_string($conn, $filter_last_name);

$filter_mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT);
$mobile = mysqli_real_escape_string($conn, $filter_mobile);

$filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
$pass = mysqli_real_escape_string($conn, md5($filter_pass));

$filter_cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_STRING);
$cpass = mysqli_real_escape_string($conn, md5($filter_cpass));

// Check if the mobile number has exactly 10 digits
if (!preg_match('/^\d{10}$/', $mobile)) {  // Checks for exactly 10 digits
   $message[] = 'Invalid mobile number! It must be exactly 10 digits.';
} else {
   // Check if the mobile number already exists
   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE mobile = '$mobile'") or die('Mobile number query failed: ' . mysqli_error($conn));

   if (mysqli_num_rows($select_users) > 0) {
       $message[] = 'User already exists with this mobile number!';
   } else {
       // Check if password and confirm password match
       if ($pass != $cpass) {
           $message[] = 'Confirm password does not match!';
       } else {
           // Insert the new user into the database
           $query = "INSERT INTO `users`(first_name, last_name, mobile, password) 
                     VALUES('$first_name', '$last_name', '$mobile', '$pass')";
           if (mysqli_query($conn, $query)) {
               $message[] = 'Registered successfully!';
               header('location:login.php');
           } else {
               $message[] = 'Error: ' . mysqli_error($conn);
           }
       }
   }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<section class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <input type="text" name="first_name" class="box" placeholder="Enter your first name" required>
    <input type="text" name="last_name" class="box" placeholder="Enter your last name" required>
    <input type="text" name="mobile" class="box" placeholder="Enter your mobile number" required>
    <input type="password" name="pass" class="box" placeholder="Enter your password" required>
    <input type="password" name="cpass" class="box" placeholder="Confirm your password" required>
    <input type="submit" class="btn" name="submit" value="Register Now">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</section>

</body>
</html>
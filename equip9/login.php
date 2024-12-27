<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $filter_mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT);
   $mobile = mysqli_real_escape_string($conn, $filter_mobile);
   
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
   $pass = mysqli_real_escape_string($conn, md5($filter_pass));
   
   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE mobile = '$mobile' AND password = '$pass'") or die('query failed');
   


   if(mysqli_num_rows($select_users) > 0){
      
      $row = mysqli_fetch_assoc($select_users);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_first_name'] = $row['first_name'];
         $_SESSION['user_last_name'] = $row['last_name'];
         $_SESSION['user_mobile'] = $row['mobile'];
         $_SESSION['user_id'] = $row['id'];
         header('location:landing.php');
     

      }else{
         $message[] = 'no user found!';
      }

   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <style>
        /* General button styles */
        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            text-align: center;
            display: inline-flex;
            align-items: center;
            color: white;
            transition: background-color 0.3s ease;
        }

        /* Facebook Button */
        .facebook {
            background-color: #1877F2; /* Facebook Blue */
        }

        .facebook .icon {
            width: 20px;
            height: 20px;
            background-color: white;
            mask: url('https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg') no-repeat center;
            -webkit-mask: url('https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg') no-repeat center;
            margin-right: 10px;
        }

        .facebook:hover {
            background-color: #165EAB;
        }

        /* Google Button */
        .google {
            background-color: #4285F4; /* Google Blue */
            background-image: linear-gradient(to right, #4285F4, #34A853, #FBBC05, #EA4335);
        }

        .google .icon {
            width: 20px;
            height: 20px;
            background-color: white;
            mask: url('https://upload.wikimedia.org/wikipedia/commons/a/a4/Google_2015_logo.svg') no-repeat center;
            -webkit-mask: url('https://upload.wikimedia.org/wikipedia/commons/a/a4/Google_2015_logo.svg') no-repeat center;
            margin-right: 10px;
        }

        .google:hover {
            background-color:rgb(245, 243, 234);
        }

        /* Apple Button */
        .apple {
            background-color: #000000; /* Apple Black */
        }

        .apple .icon {
            width: 20px;
            height: 20px;
            background-color: white;
            mask: url('https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg') no-repeat center;
            -webkit-mask: url('https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg') no-repeat center;
            margin-right: 10px;
        }

        .apple:hover {
            background-color: #333333;
        }
    </style>

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
      <h3>login now</h3>
      <input type="text" name="mobile" class="box" placeholder="Enter your mobile number" required>
    <input type="password" name="pass" class="box" placeholder="Enter your password" required>
    <input type="submit" class="btn" name="submit" value="Login Now"><br></n>

    
    <!-- Google Button -->
    <button class="btn google">
        <span class="icon"></span> Google
    </button>

    <!-- Facebook Button -->
    <button class="btn facebook">
        <span class="icon"></span> Facebook
    </button>

    <!-- Apple Button -->
    <button class="btn apple">
        <span class="icon"></span> Apple
    </button>
      <p>don't have an account? <a href="register.php">register now</a></p>
   </form>

</section>

</body>
</html>
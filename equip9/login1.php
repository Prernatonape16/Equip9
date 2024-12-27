<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Include Facebook SDK for JavaScript -->
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : 'YOUR_FACEBOOK_APP_ID', // Replace with your Facebook App ID
                cookie     : true,
                xfbml      : true,
                version    : 'v10.0'
            });
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .form-container h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        .box {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .fb-login-button {
            width: 100%;
            margin: 10px 0;
        }
        p {
            text-align: center;
        }
        a {
            color: #4CAF50;
        }
    </style>
</head>
<body>

<!-- Login Form -->
<div class="form-container">
    <form action="login_process.php" method="post">
        <h3>Login Now</h3>

        <!-- Mobile Number Field -->
        <input type="text" name="mobile" class="box" placeholder="Enter your mobile number" required>

        <!-- Password Field -->
        <input type="password" name="pass" class="box" placeholder="Enter your password" required>

        <!-- Submit Button -->
        <input type="submit" class="btn" name="submit" value="Login Now">

        <!-- Facebook Login Button -->
        <div class="fb-login-button" data-width="" data-size="large" data-button-type="continue_with" data-auto-logout-link="false" data-use-continue-as="false" onlogin="checkLoginState();"></div>
        <div id="appleid-signin" class="btn btn-primary"></div>
        <p>Don't have an account? <a href="register.php">Register Now</a></p>
    </form>
</div>

<!-- Facebook Login Callback -->
<script>
    function checkLoginState() {
        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                // User is logged in and connected to the app
                FB.api('/me', {fields: 'name,email'}, function(response) {
                    console.log('Facebook User Name: ' + response.name);
                    console.log('Facebook User Email: ' + response.email);
                    // Send this data to your server (AJAX or redirect with query params)
                });
            } else {
                console.log('User is not logged in.');
            }
        });
    }
</script>

</body>
</html>

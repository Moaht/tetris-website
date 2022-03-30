<?php

define('DB_SERVER', '127.0.0.1:3306');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '123');
define('DB_NAME', 'tetris');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check if connection failed
if($conn === false){
    die("Error: Could not connect to the server " . mysqli_connect_error());
}
 
// // Initialize the session
// session_start([
//     'use_only_cookies' => 1,
//     'cookie_lifetime' => 0,
//     'cookie_secure' => 1,
//   ]);
 
// // Check if the user is already logged in, if yes then redirect him to welcome page
// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
//     header("location: index.php");
//     exit;
// }

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $username = $_REQUEST["username"];
    $email = $_REQUEST["email"];
    $firstName = $_REQUEST["firstName"];
    $lastName = $_REQUEST["lastName"];
    $password = $_REQUEST["password"];
    $avatar = $_REQUEST["avatar"];
    if ($_REQUEST["display"] = "yes") {$display = 1;}
    if ($_REQUEST["display"] = "no")  {$display = 0;}


    $user_exists = mysqli_num_rows(mysqli_query($conn, "SELECT username FROM Users WHERE username='$username'"));
    $email_exists = mysqli_num_rows(mysqli_query($conn, "SELECT username FROM Users WHERE email='$email'"));

    // Creating a variable to carry error to HTML if an error is incurred
    $user_error = 0;
    $email_error = 0;
    
    if ($user_exists){
        $user_error = 1;
        echo "USER EXISTS";
    }

    if ($email_exists){
        echo "EMAIL EXISTS";
        $email_error = 1;
    }


    //
    if (!$user_error && !$email_error){

        // Taking data from query string and storing into a variable
        $create_account = "INSERT INTO tetris.Users (username, firstname, lastname, password, display, avatar, email) VALUES ('$username', '$firstName', '$lastName', '$password', '$display', '$avatar', '$email')";

        // Using the opened connection and the query string we just made
        if (mysqli_query($conn, $create_account)) {
        echo "New record created successfully";
        } else {
        echo "Error: " . $create_account . "<br>" . mysqli_error($conn);
        }
    }

}


mysqli_close($conn);

?>







<!DOCTYPE html>
<html>
    <head>
    <title>Welcome to TETRIS BITCHES! :></title>
    <link rel="stylesheet" href="../css/styles.css">
    </head>

    <body>

        <!-- Top of page menu navigation bar -->
        <?php 
        require_once '../src/navbar.php'; 
        ?>

        <div class="main">

            <div class="splash-box">

                <!-- Login form start -->
                <form action="action_page.php" method="post">

                    <!-- Shows user avatar. Not completely implemented yet. -->
                    <div class="avatar-container">
                        <img src="../images/T.png" alt="Avatar" class="avatar"><br>
                        You're not signed in! <br><br>

                        <!-- Checks if username and email exists and displays appropriate message -->
                        <?php
                        if ($user_error && $email_error){
                            echo "<strong style='color: red'>*Username and email are already associated with an account</strong><br><br>";
                        } else if ($user_error){
                            echo "<strong style='color: red'>*Username is already associated with an account</strong><br><br>";
                        }else if($email_error){
                            echo "<strong style='color: red'>*Email is already associated with an account</strong><br><br>";
                        }
                        ?>
                        Don't have a user account? <a href="register.php">Register now</a>
                    </div>

                    <div class="container" style="padding-bottom: 0px">
                        <label for="uname"><b>Username</b></label><br>
                        <input type="text" placeholder="Enter Username" name="uname" required>
                        <br>

                        <label for="password"><b>Password</b></label><br>
                        <input type="password" placeholder="Enter Password" name="password" required>

                        <button type="submit"><b>Login</b></button>
                        <label for="remember">
                        <input type="checkbox" checked="checked" name="remember">Remember me
                        </label>
                        <br>
                    </div>

                    <div class="container">
                        <button type="button" class="register"><b>Register</b></button>
                        <span class="forgot-password"><a href="#" >Forgot password?</a></span>
                    </div>
                </form>

            </div>

        </div> 

    </body>

</html>
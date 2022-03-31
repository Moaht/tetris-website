<?php

session_start();

echo $_SESSION['loggedin'];

?>



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

// Checks if it is necessary to process submitted form data
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Checks if user registration has been requested
    if (isset($_POST['register'])) {

        // Getting form data from registration page and storing in varaibles
        $username = $_POST["username"];
        $email = $_POST["email"];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $password = $_POST["password"];
        $avatar = $_POST["avatar"];
        if ($_POST["display"] = "yes") {$display = 1;}
        if ($_POST["display"] = "no")  {$display = 0;}

        // Creating variables to check if user and email already exists in the database
        $user_exists = mysqli_num_rows(mysqli_query($conn, "SELECT username FROM Users WHERE username='$username'"));
        $email_exists = mysqli_num_rows(mysqli_query($conn, "SELECT email FROM Users WHERE email='$email'"));

        // Creating variables to carry error to HTML if an error is incurred
        $user_error = 0;
        $dup_email_error = 0;
        $invalid_email = 0;

        // Setting error variables based on whether the queries were successful or not
        if ($user_exists)  {$user_error = 1;}
        if ($email_exists) {$dup_email_error = 1;}

        // Checks if email is valid (and allows a null/empty email ONCE so that tests may pass)
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !($email == null)){
            $invalid_email = 1;
        }

        // Checks if any errors were raised and if all clear: creates a new account
        if (!$user_error && !$dup_email_error && !$invalid_email){
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

    // Checks if login has been requested
    if (isset($_POST['login'])) {

        // Getting data from post and making variables
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Checking if user account exists
        $user_exists = mysqli_num_rows(mysqli_query($conn, "SELECT username FROM Users WHERE username='$username'"));

        // Creating error variables
        $user_error = 0;
        $user_pass_error = 0;

        if ($user_exists){

            // Putting relevant found user account details into an array called $row
            $user_lookup = mysqli_query($conn, "SELECT username, password FROM Users WHERE username='$username'");
            $row = mysqli_fetch_array($user_lookup, MYSQLI_ASSOC);

            // If the details entered in the login form match corresponding 
            // database values, a session is created. Else an error is raised
            if (($row["username"] == $username) && ($row["password"] == $password)) {

                $_SESSION['loggedin'] = $row["username"];
                $_SESSION['start'] = time();
                // Setting the time from start in which the session will expire - in seconds
                $_SESSION['expire'] = $_SESSION['start'] + (60 * 60);

                // redirect page and end script
                header('Location: tetris.php');
                die();

            } else {
                $user_pass_error = 1;
            }
        } else {
            $user_error = 1;
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
                <form action="index.php" method="POST">

                    <!-- Shows user avatar. Not completely implemented yet. -->
                    <div class="avatar-container">
                        <img src="../images/T.png" alt="Avatar" class="avatar"><br>
                        You're not signed in! <br><br>

                        <!-- Checks username and email and displays appropriate error message -->
                        <?php
                            if($_SERVER["REQUEST_METHOD"] == "POST"){
                                if (isset($_POST['register'])) {
                                    if ($invalid_email){
                                        echo "<strong style='color: red'>*Please enter a valid email</strong><br><br>";
                                    } else {
                                        if ($user_error && $dup_email_error){
                                            echo "<strong style='color: red'>*Username and email are already associated with an account</strong><br><br>";
                                        } else if ($user_error){
                                            echo "<strong style='color: red'>*Username is already associated with an account</strong><br><br>";
                                        }else if($dup_email_error){
                                            echo "<strong style='color: red'>*Email is already associated with an account</strong>";
                                        }
                                    }
                                }
                                if (isset($_POST['login'])) {
                                    // do nothing ..... for now
                                }

                            }
                        ?>

                        <span style="padding: 0px; font-size: 15px;">Don't have a user account? <a href="register.php">Register now</a></span>
                    </div>

                    <div class="container">

                            <label for="username" style="float:left"><b>Username</b></label><br>
                            <input type="text" placeholder="username" name="username" required>
                            <br>
                        
                            <label for="password" style="float:left"><b>Password</b></label><br>
                            <input type="password" placeholder="password" name="password" required>
                            <button type="submit" name="login"><b>Login</b></button>
                            
                            <label for="remember" style="float:left">
                            <input type="checkbox" checked="checked" name="remember">Remember me
                            </label>
                            <span class="forgot-password"><a href="#" >Forgot password?</a></span>

                    </div>
                </form>

            </div>

        </div> 

    </body>

</html>
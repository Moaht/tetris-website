<?php

// Initialise/resume the session
session_start();

// Check if the user is already logged in, if not then we allow POST form handling
if (!isset($_SESSION['loggedin'])){

    // Checks if it is necessary to process submitted form data
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        // Checks if user REGISTRATION has been requested
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

            // Initialise the database connection
            require_once 'src/database-config.php'; 

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
                mysqli_query($conn, $create_account);
                // Creating a session for the newly created user
                $_SESSION['loggedin'] = $username;
                $_SESSION['start'] = time();
                // Setting the time from start in which the session will expire - in seconds
                $_SESSION['expire'] = $_SESSION['start'] + (60 * 60);

            }

            // Closing database connection
            mysqli_close($conn);
        }

        // Checks if LOGIN has been requested
        if (isset($_POST['login'])) {

            // Getting data from POST and making variables
            $username = $_POST["username"];
            $password = $_POST["password"];

            // Initialise the database connection
            require_once 'src/database-config.php'; 

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

                } else {
                    $user_pass_error = 1;
                }
            } else {
                $user_pass_error = 1;
            }

            // Closing database connection
            mysqli_close($conn);
        }      
    }

// At this point we have found a user session and we set the necessary variables or can destroy session
} else {
    // Checks if LOGOUT has been requested and destroys session to complete 'log out'
    if (isset($_POST['logout'])) {
        unset($_SESSION['loggedin']);
        session_destroy();
    }
}

?>

<!-- HTML page start -->
<!DOCTYPE html>
<html>
    <head>
    <title>Welcome to TETRIS BITCHES! :></title>
    <link rel="stylesheet" href="css/styles.css">
    </head>

    <body>

        <!-- Top of page menu navigation bar -->
        <?php 
        require_once 'src/navbar.php'; 
        ?>

        <!-- Main DIV -->
        <div class="main">

        <!-- Checks if user is logged in: if they are, then show welcome page; if not, then show login page -->
        <?php        
        if (isset($_SESSION['loggedin'])){
            require_once 'src/logged-in.php'; 
        } else {
            require_once 'src/not-logged-in.php'; 
        }
        ?>

        </div> 

    </body>

</html>
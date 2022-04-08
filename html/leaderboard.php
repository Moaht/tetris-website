<?php
// Initialise/resume the session
session_start();

// Check if the user is already logged in, if not then we allow POST form handling
if (!isset($_SESSION['loggedin'])){

    // Do something with scores <----------------------------------------------------------



// At this point we have found a user session and we set the necessary variables
}

// Checks if it is necessary to process submitted form data
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Checks if user REGISTRATION has been requested
    if (isset($_POST['score'])) {
    
    // Initialise the database connection
    require_once '../src/database-config.php'; 

    $username = $_SESSION['loggedin'];
    $score = $_POST['score'];
    // Taking data from query string and storing into a variable
    $registerScore = "INSERT INTO tetris.Scores (username, score) VALUES ('$username', '$score')";

    // Using the opened connection and the query string we just made
    if (mysqli_query($conn, $registerScore)) {
    echo "<script> console.log('New record created successfully')</script>";
    } else {
    echo "<script> console.log('Error: " . $registerScore . "<br>" . mysqli_error($conn) . "')</script>";
    }
    
    
    }
}

// Initialise the database connection
require_once '../src/database-config.php'; 

// Putting relevant found user account details into an array called $row
$scores_lookup = mysqli_query($conn, "SELECT username, score FROM Scores ORDER BY score DESC;");

// Closing database connection
mysqli_close($conn);

?>

<!-- HTML page start -->
<!DOCTYPE html>
<html>
    <head>
    <title>Welcome to TETRIS BITCHES! :></title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/leaderboard.css">

    </head>

    <body>

        <!-- Top of page menu navigation bar -->
        <?php 
        require_once '../src/navbar.php'; 
        ?>

        <!-- Main DIV -->
        <div class="main">

            <div class="scores-box">
                <table class="scores-table">
                    <caption>Hi-scores<br><br></caption>
                    <thead>
                        <tr><th>User</th><th>Score</th></tr>
                    </thead>
                    <tbody>
                        <?php
                        // Setting variable for maximum scores to show on table
                        $showMax = 12;
                        for ($i = 0; $i < $showMax; $i++) {
                            // Getting scores from the database one row at a time
                            $row = mysqli_fetch_array($scores_lookup, MYSQLI_ASSOC);
                            // Check if there are no more rows with entries, and if so, break from loop
                            if ($row == null){break;}
                            // Create table entries for users and their scores
                            echo "<tr><td>" . $row["username"] . "</td><td>" . $row["score"] . "</td></tr>";
                          }
                        ?>
                    </tbody>
                </table>

            </div>

        </div> 


    </body>

</html>


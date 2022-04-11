<?php

// Initialise/resume the session
session_start();

// Check if the user is already logged in, if not then we allow POST form handling
if (!isset($_SESSION['loggedin'])){
    header('Location: index.php');
    exit;

// At this point we have found a user session and we set the necessary variables
}

    $username = $_SESSION['loggedin'];

    // Initialise the database connection
    require_once 'src/database-config.php'; 

    // Putting user account details into an array called $row
    $user_lookup = mysqli_query($conn, "SELECT avatar FROM Users WHERE username='$username'");

    $row = mysqli_fetch_array($user_lookup, MYSQLI_ASSOC);

    $avatar = $row['avatar'];
    

// Closing database connection
mysqli_close($conn);

?>

<!-- HTML page start -->
<!DOCTYPE html>
<html>
    <head>
    <title>Let's play TETRIS!</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/tetris.css">

    <style>
        @font-face {
            font-family: "Pixel";
            src: url(src/fonts/upheavtt.ttf) format("truetype");
        }
    </style>

    </head>

    <body>

        <!-- Top of page menu navigation bar -->
        <?php 
        require_once 'src/navbar.php'; 
        ?>

        <!-- Main DIV -->
        <div class="main">

        <!-- Checks if user is logged in: if they are, then show tetris game; if not, then show login form -->
        <?php        
        if (isset($_SESSION['loggedin'])){
            require_once 'src/tetris-game.php'; 
        } else {
            require_once 'src/not-logged-in.php'; 
        }
        ?>
                <span><div class="next-piece-box">Next piece:<br><br><br><br><br><br><br>.</div></span>
                <span><div class="profile-box"><br>
                <?php
                    switch ($avatar) {
                        case "1":
                            echo '<img src="images/avatar-L.png" alt="Avatar" class="avatar">';
                            break;
                        case "2":
                            echo '<img src="images/avatar-T.png" alt="Avatar" class="avatar">';
                            break;
                        default:
                            echo '<img src="images/avatar-L.png" alt="Avatar" class="avatar">';
                            break;
                        }
                ?>
                <br>
                <b>User: <?php echo $username; ?> </b>
                <h3>Score: <span id="score">0</span></h3>


                <br><br><br><b>Highest score: 
                
                <?php 

                    // Currently not working ===================================

                    // Initialise the database connection
                    require_once 'src/database-config.php'; 
                    // Putting user account details into an array called $row
                    $userScoreLookUp = mysqli_query($conn, "SELECT username, score FROM Scores WHERE username='$username' ORDER BY score DESC");
                    $row = mysqli_fetch_array($userScoreLookUp, MYSQLI_ASSOC);
                    echo $row['score'];
                ?>
                
                <br><br>
                <button id="pause-button">Start the game</button></b></div></span>

        </div> 


    </body>

</html>


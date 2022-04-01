<?php

// Initialise/resume the session
session_start();

// Check if the user is already logged in, if not then we allow POST form handling
if (!isset($_SESSION['loggedin'])){
    header('Location: index.php');
    exit;

// At this point we have found a user session and we set the necessary variables
} else {
    echo "found session";
    }

?>

<!-- HTML page start -->
<!DOCTYPE html>
<html>
    <head>
    <title>Welcome to TETRIS BITCHES! :></title>
    <link rel="stylesheet" href="../css/styles.css">

    <style>
        @font-face {
            font-family: "Pixel";
            src: url(../src/fonts/upheavtt.ttf) format("truetype");
        }
    </style>

    </head>

    <body>

        <!-- Top of page menu navigation bar -->
        <?php 
        require_once '../src/navbar.php'; 
        ?>

        <!-- Main DIV -->
        <div class="main">

        <!-- Checks if user is logged in: if they are, then show tetris game; if not, then show login form -->
        <?php        
        if (isset($_SESSION['loggedin'])){
            require_once '../src/tetris-game.php'; 
        } else {
            require_once '../src/not-logged-in.php'; 
        }
        ?>
        </div> 
    </body>

</html>
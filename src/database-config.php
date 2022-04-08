<?php
    // Connecting to the database
    define('DB_SERVER', '127.0.0.1:3306');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '123');
    define('DB_NAME', 'tetris');

    // Checking if database connection was successful - echo error if not
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if($conn === false){
        die("Error: Could not connect to the server " . mysqli_connect_error());
    }
?>

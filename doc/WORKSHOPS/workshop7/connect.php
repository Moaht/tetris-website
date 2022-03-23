<?php
$username = "webuser";
$password = "webpass";
$dbname = "webdev2";
// Create connection
$conn = mysqli_connect("localhost", $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully"
?>

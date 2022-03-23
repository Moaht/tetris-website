<?php
require "connect.php";

if( isset($_POST['uname']) && isset($_POST['task'])){
  $sql = "INSERT INTO ToDo VALUES('" . $_POST["task"] ."','2022-04-01',
  (SELECT userid FROM Users WHERE username = '" . echo $_POST["uname"] . "');"

  if ( mysqli_query($conn, $sql) ) {
    echo "New task added successfully";
  } else {
    echo "Error: ". mysqli_error($conn);
  }
}
mysqli_close($conn);
?>

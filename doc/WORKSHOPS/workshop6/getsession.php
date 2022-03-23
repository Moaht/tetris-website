<?php
if(isset($_SESSION["name"])){
  echo "Name is " . $_SESSION["name"] ."<br>";
} else {
  echo "Cookie name not set<br>";
}
if(isset($_SESSION["sname"])){
  echo "Surname is " . $_SESSION["sname"] ."<br>";
} else {
  echo "Cookie sname not set!<br>";
}
?>

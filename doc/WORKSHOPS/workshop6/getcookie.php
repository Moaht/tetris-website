<?php
if(isset($_COOKIE["name"])){
  echo "Name is " . $_COOKIE["name"] ."<br>";
} else {
  echo "Cookie name not set<br>";
}
if(isset($_COOKIE["sname"])){
  echo "Surname is " . $_COOKIE["sname"] ."<br>";
} else {
  echo "Cookie sname not set!<br>";
}
?>

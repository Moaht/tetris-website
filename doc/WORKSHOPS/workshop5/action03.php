<?php
$name=$_GET['uname'];
$error=false;
if(empty($name)) {
    $error=true;
    echo "Name not set<br>";
}
if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
    $error=true;
    echo "Names only contain letters and whitespace<br>";
}

$passwd=$_GET['passwd'];
if(empty($passwd)) {
    $error=true;
    echo "Passwort not set<br>";
}
if (strlen($passwd)<5) {
    $error=true;
    echo "Passwort to short<br>";
}
if (!preg_match("/[\*\#\+\-]+/",$passwd)) {
    $error=true;
    echo "Password must have at least one special character<br>";
}
if (!preg_match("/[a-z]+/",$passwd) or !preg_match("/[A-Z]+/",$passwd)) {
    $error=true;
    echo "Password must have at least one lower case letter and one upper case letter<br>";
}
if (!preg_match("/[0-9]{2}/",$passwd)) {
    $error=true;
    echo "Password must have at least two numbers<br>";
}
if (preg_match("/[ ]+/",$passwd)) {
    $error=true;
    echo "Password must not contain whitespaces<br>";
}
if (!$error) {
    header("Location: ./success.html");
}
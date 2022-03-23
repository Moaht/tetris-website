<?php
$number=$_GET["number"];
if (!isset($number)) {
    echo "variable not set";
} elseif (!is_numeric($number)) {
    echo "variable not a number";
} elseif ($number % 2 == 0) {
    echo "even";
} elseif ($number % 2 == 1) {
    echo "odd";
}
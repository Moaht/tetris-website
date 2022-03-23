<?php
echo "Selection:";
echo "<ul>";
if(!empty($_GET['selection'])) {
    foreach($_GET['selection'] as $check) {
        echo "<li>" . $check . "</li>";
    }
}
echo "</ul>";
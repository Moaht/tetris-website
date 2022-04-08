<?php
echo 
'<div class="navbar">
    <button type="submit" class="nav-button" name="home" onclick="location.href=';
echo "'index.php'";
echo '"><b>Home</b></button>
<span class="right"><button type="submit" class="nav-button" name="tetris" onclick="location.href=';
echo "'tetris.php'";
echo '"><b>Play Tetris!</b></button></span>
<span class="right"><button type="submit" class="nav-button" name="Leaderboard" onclick="location.href=';
echo "'leaderboard.php'";
echo '"><b>Leaderboard</b></button></span>';
// Check if the user is already logged in, if they are, then we display the 'Log out' button
if (isset($_SESSION['loggedin'])){
    echo '<span class="right"><form action="index.php" method="POST">
    <button type="submit" class="nav-button" name="logout"><b>Log Out</b></button></form></span>';
}
echo '</div>';
?>




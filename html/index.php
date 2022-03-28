<!DOCTYPE html>
<html>
<head>
<title>Welcome to TETRIS BITCHES! :></title>
<link rel="stylesheet" href="../css/styles.css">
</head>

<body>

<!-- Top of page menu navigation bar -->
<?php 
require_once '../src/navbar.php'; 
?>


<div class="main">


<div class="splash-box">

<form action="action_page.php" method="post">
  <div class="avatar-container">
    <img src="../images/T.png" alt="Avatar" class="avatar">
    <p>You're not signed in!</p>
    <br>
    <p style="font-size: 15px">Don't have a user account? <a href="register.php">Register now</a></p>
  </div>


  <div class="container">
    <label for="uname"><b>Username</b></label><br>
    <input type="text" placeholder="Enter Username" name="uname" required>
    <br>

    <label for="password"><b>Password</b></label><br>
    <input type="password" placeholder="Enter Password" name="password" required>

    <button type="submit"><b>Login</b></button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>
  <div class="container">
    <button type="button" class="register">Register</button>
    <span class="forgot-password"><a href="#" >Forgot password?</a></span>
  </div>
</form>


</div>


    </div> 

</body>
</html>
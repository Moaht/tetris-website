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


<div class="feature-box">

<form action="action_page.php" method="post">
  <div class="imgcontainer">
    <img src="../images/L.png" alt="Avatar" class="avatar">
    <p>You're not signed in!</p>
    <br>
    <p style="font-size: 15px">Please login or <a href="register.php">create an account</a></p>
  </div>


  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <button type="submit"><b>Login</b></button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>
  <div class="container">
    <button type="button" class="register">Register</button>
    <span class="psw"><a href="#">Forgot password?</a></span>
  </div>
</form>


</div>


    </div> 

</body>
</html>
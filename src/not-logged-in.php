<div class="login-box">

<!-- Login form start -->
<form action="index.php" method="POST">

    <!-- Shows user avatar. Not completely implemented yet. -->
    <div class="avatar-container">
        <img src="../images/avatar-T.png" alt="Avatar" class="avatar"><br>
        <br>You're not signed in! <br><br>

        <!-- Checks username and email and displays appropriate error message -->
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if (isset($_POST['register'])) {
                    if ($invalid_email){
                        echo "<strong style='color: red'>*Please enter a valid email</strong><br><br>";
                    } else {
                        if ($user_error && $dup_email_error){
                            echo "<strong style='color: red'>*Username and email are already associated with an account</strong><br><br>";
                        } else if ($user_error){
                            echo "<strong style='color: red'>*Username is already associated with an account</strong><br><br>";
                        }else if($dup_email_error){
                            echo "<strong style='color: red'>*Email is already associated with an account</strong><br><br>";
                        }
                    }
                }
                if (isset($_POST['login'])) {
                    if ($user_pass_error){
                        echo "<strong style='color: red'>*Username password combination not found</strong><br><br>";
                    }
                }

            }
        ?>

        <span style="padding: 0px; font-size: 15px;">Don't have a user account? <a href="register.php">Register now</a></span>
    </div>

    <div class="container">

            <label for="username" style="float:left"><b>Username</b></label><br>
            <input type="text" placeholder="username" name="username" required>
            <br>
        
            <label for="password" style="float:left"><b>Password</b></label><br>
            <input type="password" placeholder="password" name="password" required>
            <button type="submit" name="login"><b>Login</b></button>
            
            <label for="remember" style="float:left">
            <input type="checkbox" checked="checked" name="remember">Remember me
            </label>
            <span class="forgot-password"><a href="#" >Forgot password?</a></span>

    </div>
</form>

</div>
<!DOCTYPE html>
<html>

    <head>
        <title>Tetris - New user registration</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>

    <body>

        <!-- Top of page menu navigation bar -->
        <?php 
        require_once 'src/navbar.php'; 
        ?>

        <div class="main">

            <div class="registration-box">

                <form action="index.php" method="POST">

                    <div class="container">

                        <!-- Title of registration form-->
                        <h1>Registration</h1>
                        <p>Fields marked with an asterisk (*) are required fields.</p>

                        <!-- Left-hand side of registration form-->
                        <span class="regbox-left">
                            <label for="Username"><b>Username*</b><br></label>
                            <input type="text" placeholder="Username" name="username" required>
                            <br>

                            <label for="email"><b>Email*</b><br></label>
                            <input type="text" placeholder="Enter Email" name="email">
                            <br>

                            <label for="Password"><b>Password*</b><br></label>
                            <input type="Password" placeholder="Enter Password" name="password" required>
                            <br>

                            <label for="Confirm Password"><b>Confirm Password*</b><br></label>
                            <input type="Password" placeholder="Confirm Password" name="confirm-pass" required>
                        </span> 

                        <!-- Right-hand side of registration form-->
                        <span class="right">
                            <label for="First Name"><b>First Name*</b><br></label>
                            <input type="text" placeholder="First Name" name="firstName" required>
                            <br>

                            <label for="Last Name"><b>Last Name*</b><br></label>
                            <input type="text" placeholder="Last Name" name="lastName" required>
                            <br>
                            
                            <label for="avatar"><b>Choose avatar:</b></label><br><br>
                            <input type="radio" id="l-shape" checked="checked" name="avatar" value="1" required>
                            <label for="l-shape"><img src="images/L.png" alt="That LLLLovely 'ell' shape" class="avatar"></label>
                            <input type="radio" id="t-shape" name="avatar" value="2" required>
                            <label for="t-shape"><img src="images/T.png" alt="That TTTerrific 'tee' shape" class="avatar"></label>
                        </span>

                        <!-- Bottom & centralised section of registration form-->
                        <div class="center" style="padding-top: 10px">
                        <label for="display"><b>Display scores on leaderboard?*</b></label>
                        <input type="radio" id="yes-scores" checked="checked" name="display" value="yes" required>
                        <label for="yes-scores">Yes</label>
                        <input type="radio" id="no-scores" name="display" value="no" required>
                        <label for="no-scores">No</label>
                        <br><br><b>By creating an account you agree to our <a href="#">Terms and conditions</a></b><br>
                        <button type="submit" class="register-button" name="register">Register</button>
                        </div>

                    </div>  

                </form>

            </div> 

        </div> 

    </body>

</html>
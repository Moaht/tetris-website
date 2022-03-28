<!DOCTYPE html>
<html>

    <head>
        <title>New user registration</title>
        <link rel="stylesheet" href="../css/styles.css">
    </head>

    <body>

        <!-- Top of page menu navigation bar -->
        <?php 
        require_once '../src/navbar.php'; 
        ?>

        <div class="main">

            <div class="registration-box">

                <form action="action_page.php">

                    <div class="container">

                        <h1>Registration</h1>
                        <p>Fields marked with an asterisk (*) are required fields.</p>

                        <span class="regbox-left">
                            <label for="Username"><b>Username*</b><br></label>
                            <input type="text" placeholder="Username" name="Username" required>
                            <br>

                            <label for="email"><b>Email</b><br></label>
                            <input type="text" placeholder="Enter Email" name="email">
                            <br>

                            <label for="Password"><b>Password*</b><br></label>
                            <input type="Password" placeholder="Enter Password" name="Password" required>
                            <br>

                            <label for="Confirm Password"><b>Confirm Password*</b><br></label>
                            <input type="Password" placeholder="Confirm Password" name="Confirm Password" required>
                            <div style="padding-bottom: 20px" ></div>
                        </span> 

                        <span class="right">
                                <label for="First Name"><b>First Name*</b><br>
                                </label>
                                <input type="text" placeholder="First Name" name="First Name" required>
                                <br>

                                <label for="Last Name"><b>Last Name*</b><br>
                                </label>
                                <input type="text" placeholder="Last Name" name="Last Name" required>
                                <br>
                                
                                <b>Choose avatar:</b><br><br>
                                    <input type="radio" id="l-shape" checked="checked" name="avatar-select" value="l-shape" required>
                                    <label for="l-shape"><img src="../images/L.png" alt="That LLLLovely 'ell' shape" class="avatar"></label>
                                    <input type="radio" id="t-shape" name="avatar-select" value="t-shape" required>
                                    <label for="t-shape"><img src="../images/T.png" alt="That TTTerrific 'tee' shape" class="avatar"></label>
                                <br>
                        </span>

                    </div>
                </form>
                    <div class="center">
                    <div style="padding-bottom: 20px" ></div>
                    <b>Display scores on leaderboard?*</b>
                    <input type="radio" id="yes-scores" checked="checked" name="leaderboards" value="yes-scores" required>
                    <label for="yes-scores">Yes</label>
                    <input type="radio" id="yes-scores" name="leaderboards" value="yes-scores" required>
                    <label for="no-scores">No</label>

                    <br>By creating an account you agree to our <a href="#">Terms & Privacy</a>.
                    <br>
                    <button type="submit" class="register-button">Register
                    </button>
                    </div>  
            </div> 

        </div> 

    </body>

</html>
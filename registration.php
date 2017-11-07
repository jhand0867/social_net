<?php 
require 'config/config.php';
require 'includes/form_handlers/registration_handler.php';
require 'includes/form_handlers/login_handler.php';
?>

<html>
<head>
	<title>Welcome To ...</title>
    <link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
</head>
<body>
<?php
    if(isset($_POST['reg_button']))
    {
        echo '<script type="text/javascript">
         $(document).ready(function(){
            $("#first").hide();
            $("#second").show();
         });
        </script>';
    }
?>
    <div class="wrapper">
        <div class="login_box">
            <div class="login_header">
                <h1>Social Net</h1>
                Login or Sign up
            </div>
            <div id="first">
                <form action="registration.php" method="POST">
                    <input type="text" name="login_email" placeholder="E-mail Adrress" 
                    value="<?
                    if (isset($_SESSION['login_email']))
                    {
                        echo $_SESSION['login_email'];
                    }
                     ?>" required>
                    <br>
                    <input type="password" name="login_password" placeholder="Password">
                    <br>
                    <input type="submit" name="login_button" value="Login">
                    <?if(in_array("Incorrect loging, please try again", $error_array)) 
                         echo "<br>Incorrect loging, please try again"; ?>
                    <br>
                    <a href="#" id="signup" class="signup">Nedd an acount? Sign up here!</a>
                    
                </form>
            </div>
            <div id="second">
            	<form action="registration.php" method="POST">
                    <input type="text" name="reg_fname" required placeholder="First Name"
                    value="<?
                    if (isset($_SESSION['reg_fname']))
                    {
                        echo $_SESSION['reg_fname'];
                    }
                     ?>">
                    <br>
                    <?if(in_array("First name must be between 2 and 25 characters <br>", $error_array)) 
                         echo "First name must be between 2 and 25 characters <br>"; ?>
                    
                    <input type="text" name="reg_lname" required placeholder="Last Name"
                    value="<?
                    if (isset($_SESSION['reg_lname']))
                    {
                        echo $_SESSION['reg_lname'];
                    }
                     ?>">
                    <br>
                    <?if(in_array("Last name must be between 2 and 25 characters <br>", $error_array)) 
                         echo "Last name must be between 2 and 25 characters <br>"; ?>
                    
                    <input type="email" name="reg_email" required placeholder="Email"
                    value="<?
                    if (isset($_SESSION['reg_email']))
                    {
                        echo $_SESSION['reg_email'];
                    }
                     ?>">
                    <br>
                    <?if(in_array("Invalid e-mail format <br>", $error_array)) echo "Invalida e-mail format <br>"; ?>
                    
                    <input type="email" name="reg_email1" required placeholder="Confirm Email"
                    value="<?
                    if (isset($_SESSION['reg_email1']))
                    {
                        echo $_SESSION['reg_email1'];
                    }
                     ?>">
                    <br>
                    <?if(in_array("Emails don't match! <br>", $error_array)) echo "Emails don't match! <br>"; 
                      else if(in_array("Invalid e-mail format <br>", $error_array)) echo "Invalida e-mail format <br>"; 
                      else if(in_array("E-mail already in use <br>", $error_array)) echo "E-mail already in use <br>"; ?>
                
                    <input type="password" name="reg_password" required placeholder="Password">
                    <br>
                    <input type="password" name="reg_password1" required placeholder="Confirm Password">
                    <br>
                    <?if(in_array("Password don't match <br>", $error_array)) echo "Password don't match <br>"; 
                      else if(in_array("Password can only contain English characters and numbers <br>", $error_array)) 
                        echo "Password can only contain English characters and numbers <br>"; 
                      else if(in_array("Password must be between 5 and 30 characters <br>", $error_array)) 
                        echo "Password must be between 5 and 30 characters <br>"; ?>

                    <select name="reg_language">
                        <option value="ENG">Preferred Language</option>
                        <option value="SPA">Spanish</option>
                        <option value="ENG">English</option></select>
                    <br>

                    <div class="sel_gender">
                    <input type="radio" name="reg_gender" value="M">Male
                    <input type="radio" name="reg_gender" value="F">Female
                    </div>
                    <br><br>


                    <input type="submit" name="reg_button" value="Register">
                    <br>
                    <?if(in_array("<span style='color: #14C800'>You're all set! <br> Go ahead and log in.</span><br>", 
                    $error_array)) echo "<span style='color: #14C800'>You're all set! <br> Go ahead and log in.</span><br>";
                    unset($_POST['reg_button'])?>
                    <a href="#" id="signin" class="signin">Already a member? Sing in here!</a>
                    
            	</form>
            </div>
        </div>
    </div>
</body>
</html>
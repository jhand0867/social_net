<?php 
require 'config/config.php';
require 'includes/form_handlers/registration_handler.php';
require 'includes/form_handlers/login_handler.php';
?>

<html>
<head>
	<title>Welcome To ...</title>
    <link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
</head>
<body>

    <div class="wrapper">
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
            
        </form>

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
            <input type="submit" name="reg_button" value="Register">
            <br>
            <?if(in_array("<span style='color: #14C800'>You're all set! <br> Go ahead and log in.</span><br>", 
            $error_array)) echo "<span style='color: #14C800'>You're all set! <br> Go ahead and log in.</span><br>"; ?>

            

    	</form>
    </div>
</body>
</html>
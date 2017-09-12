<?php 
session_start();

$con = mysqli_connect("localhost","socialdata","Letmein0810","socialdata");
if( mysqli_connect_errno())
{
	echo "Failed to connect " . mysqli_connect_errno();
}

// error control vars
$fname = ""; // first name
$lname = ""; // last name
$em = ""; // email
$em1 = ""; // email compare
$pwd = ""; // password
$pwd1 = ""; // password compare
$date = ""; // registration date
$error_array = array(); // error messages

if( isset($_POST['reg_button']))
{
	$fname = strip_tags($_POST['reg_fname']); // clean tags
    $fname = str_replace(' ', '', $fname); // clean spaces
    $fname = ucfirst(strtolower($fname)); // capilatization
    $_SESSION['reg_fname']=$fname;

    $lname = strip_tags($_POST['reg_lname']);  // clean tags
    $lname = str_replace(' ', '', $lname);  // clean spaces
    $lname = ucfirst(strtolower($lname)); // capilatization
    $_SESSION['reg_lname']=$lname;

    $em = strip_tags($_POST['reg_email']);  // clean tags
    $em = str_replace(' ', '', $em);  // clean spaces
    $em = ucfirst(strtolower($em)); // capilatization
    $_SESSION['reg_email']=$em;

    $em1 = strip_tags($_POST['reg_email1']);  // clean tags
    $em1 = str_replace(' ', '', $em1);  // clean spaces
    $em1 = ucfirst(strtolower($em1)); // capilatization
    $_SESSION['reg_email1']=$em1;

    $pwd = strip_tags($_POST['reg_password']);  // clean tags

    $pwd1 = strip_tags($_POST['reg_password1']);  // clean tags

    $date = date("Y-m-d");

    // verify e-mail
    if ($em == $em1)
    {
        // check format
        if (filter_var($em,FILTER_VALIDATE_EMAIL))
        {
            $em = filter_var($em, FILTER_VALIDATE_EMAIL);
        }
        else
        {
            echo "Invalida e-mail format <br>";
        }

        // already exist?
        $e_check = mysqli_query($con, "SELECT email FROM soc_users WHERE email='$em'");

        // check return
        $num_rows = mysqli_num_rows($e_check);
        if ($num_rows > 0)
        {
            echo "E-mail already in use <br>";
        }
    }
    else 
    {
        echo "Emails don't match! <br>";
    }

    // validate other fields
    if (strlen($fname > 25 || strlen($fname) < 2))
    {
        echo "First name must be between 2 and 25 characters <br>";
    }
    
    if (strlen($lname > 25 || strlen($lname) < 2))
    {
        echo "Last name must be between 2 and 25 characters <br>";
    }

    if ($pwd != $pwd1)
    {
        echo "Password don't match <br>";
    }
    else
    {
        if (preg_match('/[^A-Za-z0-9]/', $pwd))
        {
            echo "Password can only contain English characters and numbers <br>";
        }
    }

    if (strlen($pwd > 30 || strlen($pwd) < 5))
    {
        echo "Password must be between 5 and 30 characters <br>";
    }


}


?>

<html>
<head>
	<title>Welcome To ...</title>
</head>
<body>

	<form action="registration.php" method="POST">
        <input type="text" name="reg_fname" required placeholder="First Name"
        value="<?
        if (isset($_SESSION['reg_fname']))
        {
            echo $_SESSION['reg_fname'];
        }
         ?>">
        <br>
        <input type="text" name="reg_lname" required placeholder="Last Name"
        value="<?
        if (isset($_SESSION['reg_lname']))
        {
            echo $_SESSION['reg_lname'];
        }
         ?>">
        <br>
        <input type="email" name="reg_email" required placeholder="Email"
        value="<?
        if (isset($_SESSION['reg_email']))
        {
            echo $_SESSION['reg_email'];
        }
         ?>">
        <br>
        <input type="email" name="reg_email1" required placeholder="Confirm Email"
        value="<?
        if (isset($_SESSION['reg_email1']))
        {
            echo $_SESSION['reg_email1'];
        }
         ?>">
        <br>
        <input type="password" name="reg_password" required placeholder="Password">
        <br>
        <input type="password" name="reg_password1" required placeholder="Confirm Password">
        <br>
    	<input type="submit" name="reg_button" value="Register">
	</form>

</body>
</html>
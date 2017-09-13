<?php 
// registration handler

if ( isset($_POST['login_button']))
{
	// deal with e-mail
	$email = filter_var($_POST['login_email'], FILTER_SANITIZE_EMAIL);
	$_SESSION['login_email'] = $email;

    // deal with password
    $pwd = md5($_POST['login_password']);

    // validate user login
    $login_query = mysqli_query($con, 
    	"SELECT * FROM soc_users WHERE email='$email' AND password='$pwd'");
    if (mysqli_num_rows($login_query) == 1)
    {
    	$row = mysqli_fetch_array($login_query);
    	
    	$username = $row['username'];
    	$_SESSION['username'] = $username;

    	// if account is closed, reopen at login
    	$user_closed = $row['user_closed'];
    	if ($user_closed == 'yes')
    	{
    		$reopen_query = mysqli_query($con,
    			"UPDATE soc_users SET user_closed = 'no' 
    			WHERE email='$email'");
    	}

    	// go to site's index page
    	header("Location: index.php");
    	exit();
    }
    else
    {
    	array_push($error_array, "Incorrect loging, please try again");
    }

}

?>
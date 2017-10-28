<?php
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
            array_push($error_array,"Invalid e-mail format <br>");
        }

        // already exist?
        $email_check = mysqli_query($con, "SELECT email FROM soc_users WHERE email='$em'");

        // check return
        $num_rows = mysqli_num_rows($email_check);
        if ($num_rows > 0)
        {
            array_push($error_array, "E-mail already in use <br>");
        }
    }
    else 
    {
        array_push($error_array, "Emails don't match! <br>");
    }

    // validate other fields
    if (strlen($fname > 25 || strlen($fname) < 2))
    {
        array_push($error_array, "First name must be between 2 and 25 characters <br>");
    }
    
    if (strlen($lname > 25 || strlen($lname) < 2))
    {
        array_push($error_array, "Last name must be between 2 and 25 characters <br>");
    }

    if ($pwd != $pwd1)
    {
        array_push($error_array, "Password don't match <br>");
    }
    else
    {
        if (preg_match('/[^A-Za-z0-9]/', $pwd))
        {
            array_push($error_array, "Password can only contain English characters and numbers <br>");
        }
    }

    if (strlen($pwd > 30 || strlen($pwd) < 5))
    {
        array_push($error_array, "Password must be between 5 and 30 characters <br>");
    }

    if (empty($error_array))
    {
        $pwd = md5($pwd); // cypher password

        // generate unique username
        $username = strtolower($fname . "_" . $lname);
        $notused_query = mysqli_query($con , "SELECT username FROM soc_users WHERE username = '$username'");
        $i=0;
        while(mysqli_num_rows($notused_query) != 0)
        {
            $i++;
            $username = $username . "_" . $i;
            $notused_query = mysqli_query($con , "SELECT username FROM soc_users WHERE username = '$username'");
        }

        // assign default picture in profile
        $rand = rand(1,2);
        switch ($rand) {
            case 1:
                $profile_pic = "assets/images/profile_pics/defaults/head_deep_blue.png";
                break;
            
            default:
                $profile_pic = "assets/images/profile_pics/defaults/head_emerald.png";
                break;
        }

        // add user to database
        $add_user_query = mysqli_query($con , "INSERT INTO soc_users (id,
                          first_name, last_name, username, password, email, signup_date, 
                          profile_pic, num_posts, num_likes, user_closed, friends_array)
                          VALUES ('', '$fname' , '$lname' , '$username' , '$pwd' , '$em' , '$date',
                          '$profile_pic' , '0' , '0' , 'no' , ',')");

        // horra!! message
        array_push($error_array,"<span style='color: #14C800'>You're all set! <br> Go ahead and log in.</span><br>");

        // clear form fields
        $_SESSION['$fname']="";
        $_SESSION['$lname']="";
        $_SESSION['$em']="";
        $_SESSION['$em1']="";

    }

}



?>
<html>
<head>
	<title>Like</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<style type="text/css">
		* {
			font-family: arial, sans-serif;
			font-size:14;
		} 
	</style>

</head>
<body>
<style type="text/css">
	body {
		background-color: #fff;
	}

	form {
		top: 4px;
    	position: absolute;"
	}
</style>
<?php 
require 'config/config.php';
require 'assets/classes/User.php';
require 'assets/classes/Post.php';
require 'assets/classes/Notification.php';
require_once 'assets/classes/Utils.php';

/* Create a trace file in '/tmp/client.trace' on the local (client) machine: */
//mysqli_debug("d:t:0,/tmp/client.trace");
	
if (isset($_SESSION['username']))
{
	$loggedUsername = $_SESSION['username'];
	$userDetails = mysqli_query($con , 
		"SELECT * 
		 FROM soc_users 
		 WHERE username='$loggedUsername'");
	$user = mysqli_fetch_array($userDetails);
}
else
	header("Location: registration.php");

// get the post's id

if (isset($_GET['post_id']))
{
	$post_id = $_GET['post_id'];
}

// look for likes
$getLikes = mysqli_query( $con ,
	"SELECT post_likes , post_added_by 
	 FROM soc_posts
	 WHERE id='$post_id'");

$row = mysqli_fetch_array( $getLikes );
$total_likes = $row['post_likes'];
$liked_by = $row['post_added_by'];

$user_liked = new User( $con , $liked_by );

// like button handler
if ( isset($_POST['like_button'] ) )
{
	$total_likes++;
	$user_liked->increaseLikes();
	$post = new Post( $con , $loggedUsername );
	$post->increaseLikes( $post_id , $loggedUsername);

	// add notification 
	if ( $user_liked != $loggedUsername )
	{
		$nt = new Notification($con , $user_liked );
		$nt->createNotification($post_id, $user_liked, 'like');
	}

}

// unlike button
if ( isset($_POST['unlike_button'] ) )
{
	$total_likes--;
	$user_liked->decreaseLikes();
	$post = new Post( $con , $loggedUsername );
	$post->decreaseLikes( $post_id , $loggedUsername );

}

// check for previous likes

$previous_likes = mysqli_query( $con ,
	"SELECT * 
	 FROM soc_likes 
	 WHERE like_username = '$loggedUsername' AND like_to_post_id ='$post_id' ");
$num_rows = mysqli_num_rows($previous_likes);

if ( $num_rows > 0 )
{
	// if there are likes show unlike button
	echo '<form action="like.php?post_id=' . $post_id . '" method="POST" >
			<input type="submit" class="comment_like" name="unlike_button" value="Unlike&nbsp;&nbsp;&nbsp;&nbsp;">
			<div class="likes_value">
				' . $total_likes . ' Likes
			</div>
		 </form>';
}
else
{
	// if there are likes show unlike button
	echo '<form action="like.php?post_id=' . $post_id . '" method="POST" >
			<input type="submit" class="comment_like" name="like_button" value="Like&nbsp;&nbsp;&nbsp;&nbsp;">
			<div class="likes_value">
				' . $total_likes . ' Likes
			</div>
		 </form>';
}



?>


</body>
</html>
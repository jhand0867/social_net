<html>
<head>
	<title>Comment Frame</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>
<body>
<?php 
require "config/config.php";
require 'assets/classes/User.php';
require 'assets/classes/Post.php';

/* Create a trace file in '/tmp/client.trace' on the local (client) machine: */
//mysqli_debug("d:t:0,/tmp/client.trace");
	
if (isset($_SESSION['username']))
{
	$loggedUsername = $_SESSION['username'];
	$userDetails = mysqli_query($con , "SELECT * FROM soc_users WHERE username='$loggedUsername'");
	$user = mysqli_fetch_array($userDetails);
}
else
	header("Location: registration.php");

?>
<script>
	// comment toggle on/off
	function toggle()
	{
		element = document.getElementById("comment_section");

		if (element.style.display == "block")
			element.style.display = "none";
		else
			element.style.display = "block";			
	}
</script>

	<?php 
		// get the post's id

		if (isset($_GET['post_id']))
		{
			$post_id = $_GET['post_id'];
		}

		// get all comments

		$user_posts = mysqli_query($con , 
			"SELECT post_added_by, post_user_to 
			 FROM soc_posts
			 WHERE id='" . $post_id . "'" );

		$row = mysqli_fetch_array( $user_posts );

		$posted_to = $row['post_added_by'];

		if ( isset( $_POST['postComment' . $post_id] ))
		{
			$post_body = $_POST['post_body'];
			$post_body = mysqli_escape_string($con , $post_body);
			$date_time_now = date("Y-m-d H:i:s");

			// add comment to table
			mysqli_query( $con, 
				"INSERT INTO soc_comments
				(id,comment_body, comment_by, comment_to ,comment_date,
					comment_removed,comment_to_post_id)
				VALUES 
				('' , '$post_body' , '$loggedUsername', '$posted_to', '$date_time_now',
					'no','$post_id')");

			$returned_id = mysqli_insert_id($con);

			echo "<p>Comment posted!</p>";

		}



	 ?>

<form action="comment_frame.php?post_id=<?echo $post_id; ?>" 
	method="POST" name="postComment<?echo $post_id ?>" id="comment_form">

	<textarea name="post_body"></textarea>
	<input type="submit" name="postComment<?echo $post_id ?>" value="Post" >

</form>

<!-- load comments -->



</body>
</html>
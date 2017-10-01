<html>
<head>
	<title>Comment Frame</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>
<body>
<?php 
require 'config/config.php';
require 'assets/classes/User.php';
require 'assets/classes/Post.php';
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
			
			$utils = new Utils();

			$post_body = $utils->stringSafe($con, $post_body);
			//$post_body = mysqli_escape_string($con , $post_body);
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

	<textarea class="comment_body" name="post_body"></textarea>
	<input type="submit" class="comment_submit" name="postComment<?echo $post_id ?>" value="Post" >

</form>

<!-- load comments -->

<?php 

	$getComments = mysqli_query( $con , 
		"SELECT * 
		 FROM soc_comments 
		 WHERE comment_to_post_id ='$post_id' 
		 ORDER BY id ASC" );

	$count = mysqli_num_rows( $getComments );

	if ( $count != 0 )
	{
		while ($row = mysqli_fetch_array( $getComments ) )
		{

			$comment_body = $row['comment_body'];
			$comment_to = $row['comment_to'];
			$comment_by = $row['comment_by'];
			$comment_date = $row['comment_date'];
			$comment_removed = $row['comment_removed'];
			$comment_to_post_id = $row['comment_to_post_id'];

			// time since last post

			$utils = new Utils();

			$time_message = $utils->postInterval( $comment_date );

			$user_obj = new User( $con , $comment_by );

			//echo $user_obj

			?>

			<div class="comment_section">
	
				<!-- display picture -->
				<a href=" <?php echo $user_obj->getFirstName(); ?> " 
					target="_parent"> 
					<img src=" <?php echo $user_obj->getPic(); ?>"
					     title=" <?php echo $comment_by; ?> "
					     style="float:left" 
					     height="30">  
				</a>
				<a href=" <?php echo $user_obj->getFirstName(); ?> " 
				   target="_parent"> <b> <?php echo $user_obj->getFirstAndLastName(); ?> </b>
				</a>
				&nbsp;&nbsp;&nbsp;&nbsp;<? echo $time_message ?> <br> <? echo $comment_body ?>   
				
				<hr>
			</div>
<?
		} // end of while

	}

// assets/images/profile_pics/defaults/head_emerald.png
// 
?>





</body>
</html>
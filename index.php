<?php 

require 'includes/header.php';
require 'assets/classes/User.php';
require 'assets/classes/Post.php';

//session_destroy();

// deal with the post
if (isset($_POST['post']))
{
	$post = new Post($con, $loggedUsername);
	$post->submitPost($_POST['post_text'] , 'none');
}


?>
	<div class="user_details column">
		<a href="<? echo $user['first_name']; ?>">
			<img src="<? echo $user['profile_pic'] ?>">
		</a>
		<div class="user_details_left_right">
			<!-- User Details Data -->
			<a href=" <? echo $user['first_name']; ?> ">
			<?
				echo $user['first_name'] . "<br>"; // . $user['last_name'];
			?>
			</a>
			<?
				echo "Posts: " . $user['num_posts'] . "<br>" ;
				echo "Likes: " . $user['num_likes'];
			?>
		</div>
	</div>

	<div class="main_column column">
		<form class="post_form" action="index.php" method="POST"></form>
			<textarea class="post_text" name="post_text" id="post_text" 
			placeholder="Say something, post something"></textarea>
			<input class="post_button" type="submit" name="post" id="post_button" value="Post">
			<hr>


	</div>


</div>

</body>
</html>


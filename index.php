<?php 

require 'includes/header.php';
require 'includes/chromephp/ChromePhp.php';
require 'assets/classes/User.php';
require 'assets/classes/Post.php';

//session_destroy();

// deal with the post

//echo "starting.. <br>";



if(isset($_POST['post']))
{
	echo "post button <br>";
	//ChromePhp::log('This is just a log message');
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
		<form class="post_form" action="index.php" method="POST">
			<textarea class="post_text" name="post_text" id="post_text" 
			placeholder="Say something, post something"></textarea>
			//<?echo "here" ?>
			<input class="post_button" type="submit" name="post" id="post_button" value="Post">
			<hr>


	</div>


</div>
<!--
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
-->
</body>
</html>


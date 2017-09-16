<?php 

require 'includes/header.php';
//session_destroy();




?>
	<div class="user_details column">
		<a href="#">
			<img src="<? echo $user['profile_pic'] ?>">
		</a>
		<div class="user_details_left_right">
			<!-- User Details Data -->
			<a href="#">
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
			<textarea name="post_text"></textarea>


	</div>


</div>

</body>
</html>


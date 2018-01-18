<?php 
# post.php

include('includes/header.php');

// verify user preferred_lang
$U = new Utils();
$lang = $U->selectLanguage($con , $user['username']);

if (isset($_GET['id']))
{
	$id = $_GET['id'];
}
else
	$id = 0;

 ?>

<div class="user_details column">
<a href="profile.php?profile_username=<? echo $user['username']; ?>&t=0">
	<img src="<? echo $user['profile_pic'] ?>">
</a>
	<div class="user_details_left_right">
		<!-- User Details Data -->
		<a href=" profile.php?profile_username=<? echo $user['username']; ?>&t=0 ">
		<?
			echo $user['first_name'] . "<br>"; 
		?>
		</a>
		<?
			// lbl_post_1
			// getLangKey("lbl_post_1");
			echo $U->getLanguageKey("key_lbl_post_1",$lang). ":"  . $user['num_posts'] . "<br>" ;
			echo $U->getLanguageKey("key_lbl_like_1",$lang). ":"  . $user['num_likes'];
		?>
	</div>
</div>

<div class="main_column column">
	<div class="posts_area">
		<? 
			$post = new Post($con , $user['username']);

			$post_info = $post->loadAPost($id);

			print_r($post_info);
		?>
	</div>	

</div>
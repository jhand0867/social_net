<?php 
// messages.php

include ("includes/header.php");

$U = new Utils();
$lang = $U->selectLanguage($con , $user['username']);


?>

<div class="user_details column">
	<a href="<? echo $user['username']; ?>">
		<img src="<? echo $user['profile_pic'] ?>">
	</a>
	<div class="user_details_left_right">
		<!-- User Details Data -->
		<a href=" <? echo $user['username']; ?> ">
		<?
			echo $user['first_name'] . "<br>"; 
		?>
		</a>
		<?
			echo $U->getLanguageKey("key_lbl_post_1",$lang). ":"  . $user['num_posts'] . "<br>" ;
			echo $U->getLanguageKey("key_lbl_like_1",$lang). ":"  . $user['num_likes'];
		?>
	</div>
</div>

<div class="main_column column">



</div>
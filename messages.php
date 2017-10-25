<?php 
// messages.php

include ("includes/header.php");

$U = new Utils();
$lang = $U->selectLanguage($con , $user['username']);

$message_obj = new Message($con , $loggedUsername);
if (isset($_GET['u']))
	$user_to = $_GET['u'];
else
{
	$user_to = $message_obj->getMostRecentUser();
	if ($user_to == 'false')
		$user_to = 'new';
}
if ($user_to != 'new')
	$user_to_obj = new User ($con , $user_to);


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
			// lbl_post_1
			// getLangKey("lbl_post_1");
			echo $U->getLanguageKey("key_lbl_post_1",$lang). ":"  . $user['num_posts'] . "<br>" ;
			echo $U->getLanguageKey("key_lbl_like_1",$lang). ":"  . $user['num_likes'];
		?>
	</div>
</div>
<div class="main_column column" id="main_column">

</div>

<div class="loaded_messages column">
	<form action="" method="POST">
	<?
	if($user_to = 'new')
	{
		echo "Select the user you would like to send a message<br><br>";
		echo "To: <input type='text'";
		echo "<div class='message' id='results'></div>";
	}




	?>





	</form>





</div>
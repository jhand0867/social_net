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
if (isset($_POST['post_msg']))
{
	if (isset($_POST['msg_body']))
	{
		$check_safe = $U->stringSafe($con , $_POST['msg_body']);
		$body = $check_safe;

		$date = date("Y-m-d H:i:s");
		$message_obj->sendMessage($user_to,$body,$date);
	}
}


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
<div class="main_column column" id="main_column">
<?

if ($user_to != 'new')

	echo "<h4>You and <a href='$user_to'>" .$user_to_obj->getFirstAndLastName() ."</a></h4><hr><br>";
?>
<div class="post_message">
	<form action="" method="POST">
	<?
	if($user_to == "new")
	{
		echo "Select the user you would like to send a message<br><br>";
		echo "To: <input type='text'";
		echo "<div class='message' id='results'></div>";
	}
	else
	{
		echo "<textarea name='msg_body' id='msg_textarea' placeholder='Type your message..'></textarea>";
		echo "<input type='submit' class='info' name='post_msg' id='msg_submit' value='Send Message'>";
	}
	?>
	</form>
</div>
<?
	echo "<div class='loaded_messages'>";
	$messages = $message_obj->getMessages($user_to);
	?>
	<div class="container">
		<table class="table">
			<thead>
				<tr>
				<!--	<th>Message From</th> -->
					<th>Message</th>
					<th>Date</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
	<?
	foreach ($messages as $row) 
	{
		echo "<tr>";
		//echo "<td>" . $row['msg_user_from'] . "</td>";
		echo "<td>" . $row['msg_body'] . "</td>"; 
		echo "<td>" . $row['msg_date'] . "</td>";
		echo "<td><a href='#'>Delete</a></td>";
		echo "</tr>";
	}
	//print_r ($message_obj->getMessages($user_to));
?>
			</tbody>
		</table>
	</div>
</div>

</div>
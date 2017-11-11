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
		$_POST['msg_body'] = "";
		//$user_to = "";
		$body = "";
		$date = "";
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

<div class="user_chats column">
	<p class="title_1">Active Users</p>
	<div class="active_users">
	<?
		$S = new Session($con);
		$active_users = $S->getActiveSessions($con);
		
		$user_obj = new User($con , $user['username']);

		// find if frieds are in session

		foreach ($active_users as $rec) 
		{

			if ($user_obj->isFriend($rec['username']))
			{
				if ($user['username'] <> $rec['username']) 
				{
					$friend_user = new User($con , $rec['username']);
		?>

					<div class="msg_active_pics">
						<a href="messages.php?u=<?echo $friend_user->getUsername();?>">
							<img src="<? echo $friend_user->getPic(); ?>">
						</a>
				    </div>

				    <div class="msg_active_users_details">
				    	<a href="messages.php?u=<?echo $friend_user->getUsername();?>">
				    		<span class="title_1">
				    		<? echo $friend_user->getFirstAndLastName(); ?></span></a><br>
			    		<span class="title_1">Logged in</span>&nbsp;&nbsp;
			    		<span class="title_2"><? echo $U->postInterval($rec['login_date_time']) ?></span>
				    	
				    </div>
					<hr>
		<?			
				}
			}		
		}	
//		echo $U->getLanguageKey("key_lbl_post_1",$lang). ":"  . $user['num_posts'] . "<br>" ;
//		echo $U->getLanguageKey("key_lbl_like_1",$lang). ":"  . $user['num_likes'];
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
		echo "<input type='submit' class='info' name='post_msg' id='msg_submit' value='Send'>";
	}
	?>
	</form>
</div>
<?
	echo "<div class='loaded_messages'>";
	$messages = $message_obj->getMessages($user_to);
	
	if ($messages != "none")
	{
		?>
		<div class="container">
			<table class="table-hover">
				<tbody> 
		<? 
		foreach ($messages as $row) 
		{
			$height = 70;
			$body_len = strlen($row['msg_body'])/25;
			
			if ($body_len > 1)
			{
				$height = (round($body_len) + 1) * 35; 
			}
			
			if ($loggedUsername == $row['msg_user_to'])
			{
				$user = new User($con , $row['msg_user_to']);
				echo "<td ><img class='pic_row' src='".$user->getPic($row['msg_user_to'])."'></td>";
				echo "<td class='msg_send' background='assets/images/backgrounds/callout_noline_left.png' 
				style='background-repeat:no-repeat;background-size: 350px ". $height ."px; 
				width: 350px; height: ". $height . "px;'>" . $row['msg_body'] . "</td>"; 
				echo "<td></td>";
				echo "<td></td>";
				echo "</tr>";
				echo "<tr class='tr_empty'></tr>";
			}
			else
			{
				$user = new User($con , $row['msg_user_to']);
				echo "<td ><img class='pic_row' src='".$user->getPic($row['msg_user_to'])."'></td>";
				echo "<td></td>";
				echo "<td></td>";
				echo "<td class='msg_send' background='assets/images/backgrounds/callout_noline_right.png' 
				style='background-repeat:no-repeat;background-size: 350px ". $height ."px; 
				width: 350px; height: ". $height . "px;'>" . $row['msg_body'] . "</td>"; 
				echo "</tr>";			
				echo "<tr class='tr_empty'></tr>";
			}
		}
		?>
				</tbody>
			</table>
		</div>
	<?
	}
	?>
</div>

</div>
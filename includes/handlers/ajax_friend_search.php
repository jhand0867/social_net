<?php 
// ajax_friend_search.php
include("../../config/config.php");
include("../../assets/classes/User.php");

// parse request data

//var_dump($_POST);

$query = $_POST['query'];
$userLoggedIn = $_POST['userLoggedIn'];

// what was typed?
$names = explode(" ", $query);

if (strrpos($query, '_') !== false)
{
	// is this a username?
	$qry = "SELECT * 
		 FROM soc_users
		 WHERE username LIKE '%$query%' AND user_closed ='no'
		 LIMIT 8";
}
else if (count($names) == 2)
{
	// is the input first and last name?
	$qry = "SELECT * 
		 FROM soc_users
		 WHERE (first_name LIKE '%$names[0]%' AND last_name LIKE '%$names[1]%') AND user_closed ='no'
		 LIMIT 8";
}
else
{
	// is one name only?
	$qry = "SELECT * 
		 FROM soc_users
		 WHERE (first_name LIKE '%$names[0]%' OR last_name LIKE '%$names[0]%') AND user_closed ='no'
		 LIMIT 8";
}

$users_qry = mysqli_query($con , $qry);

if ($users_qry != "")
{
	while ($row = mysqli_fetch_array($users_qry))
	{
		$user_obj = new User($con, $userLoggedIn);

		if ($row['username'] != $userLoggedIn)
		{
			$mutual_friends = $user_obj->getMutualFriends($row['username']);
			$num_mutual_friends = count($mutual_friends) -1;
			//echo $num_mutual_friends;
		}
		else  
		{
			$mutual_friends = "";
			$num_mutual_friends = 0;
			continue;
		}

		if ($user_obj->isFriend($row['username']))
		{
			echo "
			<div class='results_display'>
				<a href='messages.php?u=".$row['username']."' style='color:#000'>
					<div class='livesearch_pic'>
						<img src='".$row['profile_pic']."'>
					</div>
					<div class='livesearch_text'>
						".$row['first_name']." " .$row['last_name'] ."
						<p class='grey'>". $num_mutual_friends . " mutual_friends" ."</p>
					</div>
				</a>
			</div>";
		}
	}
}
?>


<?php 
// 

include("../../config/config.php");
include("../../assets/classes/User.php");
include("../../assets/classes/Message.php");

/* get my vars
// $.post("includes/handler/ajax_load_search_users.php",
		{query:value, userLoggedIn: user},
*/

$queryValues = $_POST['query'];
$userLoggedIn = $_POST['userLoggedIn'];

// let's see what's been searched

// what's in the query?

//ChromePhp::log("in queryUserTable!!!");

// is there a value entered?
if ( !empty($queryValues) ) 
{
	$names = explode(" ", $queryValues);
}
else
{
	return false;
}


// if it contains "_" underscore
// look for usernames


if (strpos('_', $queryValues) !== false)
{
	$user_query = "SELECT * 
				   FROM soc_users
				   WHERE username LIKE '$queryValues%' 
				   AND user_closed='no' LIMIT 8" ; 
}

// if it's 2 words
// look for first and lastname respectively

else if (count($names) == 2 )
{
	$user_query = "SELECT * 
				   FROM soc_users
				   WHERE ( first_name LIKE '$names[0]%' AND last_name LIKE '$names[1]%' ) 
				   AND user_closed='no' LIMIT 8" ;
}
// if it's 1 word
// look for first and lastname 
else if (count($names) == 1 )
{
	$user_query = "SELECT * 
				   FROM soc_users
				   WHERE ( first_name LIKE '$names[0]%' OR last_name LIKE '$names[0]%' ) 
				   AND user_closed='no' LIMIT 8" ;

}



//echo $user_query;

$user_tbl_qry = mysqli_query( $con , $user_query );

/*if (!$user_tbl_qry) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}*/


if ( $queryValues != "" )
{

	//ChromePhp::log("in ajax_load_search_users!!!");

	while ($row = mysqli_fetch_array($user_tbl_qry))
	{
		$user_obj = new User( $con , $userLoggedIn );


		if ($row['username'] != $userLoggedIn) 
			$mutual_friends = count($user_obj->getMutualFriends($row['username'])) . " friends in common";
		else
			$mutual_friends = "";

		// build the list

		echo "<div class='results_display'>

				<a href='". $row['username'] ."' style='color:#007bff;' >
					
					<div class='livesearch_pic'>
					
						<img src='". $row['profile_pic']."'>
					
					</div>

					<div class='livesearch_text'>
					
						" . $row['first_name'] . " " . $row['last_name'] . "
					
						<p>" . $row['username'] . "</p>
					
						<p id='grey'>" . $mutual_friends ."</p>
					
					</div>

				</a>

			</div>";

	}


}

?>


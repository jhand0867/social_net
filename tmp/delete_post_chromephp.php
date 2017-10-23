<?php 
// delete_post.php

require '../../config/config.php';
require '../../assets/classes/Utils.php';
include '../ChromePhp/ChromePhp.php';

    
    ChromePhp::log($_SERVER);


if (isset($_GET['post_id']))
	ChromePhp::log("in delete_post!!");
	$post_id = $_GET['post_id'];
	ChromePhp::log("post_id = $post_id !!");

	var_dump($_POST);

if (isset($_POST['result']))
{
	ChromePhp::log("result = " . $_POST['result']);

	if( $_POST['result'] == 'true' )
	{
		ChromePhp::log( "UPDATE soc_post 
			 SET posts_deleted = 'yes' 
			 WHERE id = '$post_id'");

		$delete_post_qry = mysqli_query($con ,
			"UPDATE soc_posts 
			 SET post_deleted = 'yes' 
			 WHERE id = '$post_id'");

	}
}



 ?>
<?php 
// delete_post.php

require '../../config/config.php';

if (isset($_GET['post_id']))
	$post_id = $_GET['post_id'];

if (isset($_POST['result']))
{
	if( $_POST['result'] == 'true' )
	{
		$delete_post_qry = mysqli_query($con ,
			"UPDATE soc_posts 
			 SET post_deleted = 'yes' 
			 WHERE id = '$post_id'");
	}
}
?>
<?php  
// ajax_submit_profile_post.php

require '../../config/config.php';
include("../../assets/classes/User.php");
include("../../assets/classes/Post.php");


if(isset($_POST['post_body'])) {

	$U = new Utils();
	$U->logData("../logs/test.log", 
	 "post_body = " . $_POST['post_body'] . "\r" .
		 "user_to = " . $_POST['user_to'] . "\r" .
		 "user_from = " . $_POST['user_from'] . "\r");

	$post = new Post($con, $_POST['user_from']);
	$post->submitPost($_POST['post_body'], $_POST['user_to']);
}
	
?>
<?php 
// ajax_load_posts.php

include("../config/config.php");
include("../assets/classes/User.php");
include("../assets/classes/Post.php");

$limit = 7; // how many to show

//echo "page= " . $_REQUEST['page'] . "<br>" . 
//     "userLoggedIn= " . $_REQUEST['userLoggedIn'];

$posts = new Post($con, $_REQUEST['userLoggedIn']);

$posts->loadPostsFriends($_REQUEST , $limit);




 ?>
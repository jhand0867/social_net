<?php

require 'includes/header.php';

echo "I'm in test";

print_r ($_POST);


$req_from = "accept_requestlorena_handschu";
if ( isset($_POST[$req_from]))
{
	echo "<br>accepted !!";

}


?>
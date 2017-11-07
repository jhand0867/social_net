<?php

require 'includes/header.php';

echo "I'm in test";

var_dump ($_POST);


$req_from = "accept_requestlorena_handschu";
if ( isset($_POST[$req_from]))
{
	echo "<br>accepted !!";

}


/*$myfile = fopen("logs/test.log", "w") or die("Unable to open file!");
$txt = "Test\n";
fwrite($myfile, $txt);
$txt = "Test1\n";
fwrite($myfile, $txt);
fclose($myfile);
*/


?>
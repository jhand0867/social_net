<?php
// NOTE: This code is not fully working code, but an example!

session_start();

echo "New Session: $new_sessionid<br />";

print_r($_SESSION);

echo "<br>";

print_r($_SERVER);

echo "<br>";

echo time();
echo "<br>";
echo time() + 60;
echo "<br>";	

?>
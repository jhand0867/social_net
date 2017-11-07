<?php 
//language_handler.php

//include 'chromephp/ChromePhp.php';


    
//ChromePhp::warn('something went wrong!');
 	
$lang = "eng";

if ($lang == "eng")
	$_SESSION['xmlstr']  = simplexml_load_file("../config/lang_eng.xml");
else
	$_SESSION['xmlstr']  = simplexml_load_file("../config/lang_spa.xml");

//ChromePhp::log($xmlstr);






?>
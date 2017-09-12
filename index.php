<?php 
$con = mysqli_connect("localhost","socialdata","Letmein0810","socialdata");
if( mysqli_connect_errno())
{
	echo "Failed to connect " . mysqli_connect_errno();
}

$query = mysqli_query($con, "INSERT INTO test VALUES ('1','Joseph Handschu')");


 ?>
<html>
<head>
	<title>demo</title>
</head>
<body>
   Hello Gubda!!
</body>
</html>

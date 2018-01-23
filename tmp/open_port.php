<?php 

echo "Opening the port ...\r\n";
echo "<br>\r\n";
echo "Result = ";
echo ser_open("COM4", 9600, 8, "None", "1", "None");
echo "<br>\r\n";

if (ser_isopen() == true )
   echo "Port is open<br>\r\n";
else
   echo "Port is closed<br>\r\n";

echo "Writing (string) AT\\r ...\r\n";
echo "<br>\r\n";
echo "Result = ";
// echo ser_write("ka 001 01\r");
echo ser_write("dd 001 44\r");
echo ser_write("di 001 05\r");

echo "<br>\r\n";

echo "Sleeping ...\r\n";
echo "<br>\r\n";

sleep(1);

echo ser_write("dd 001 22\r");
echo ser_write("di 001 01\r");

echo "<br>\r\n";

echo "Sleeping ...\r\n";
echo "<br>\r\n";

sleep(1);

// echo "Bytes available for reading: ".ser_inputcount()."<br>\r\n";
/* Flush test
ser_flush(true, true);
echo "Bytes available for reading: ".ser_inputcount()."<br>\r\n";
*/

echo "Reading (string) ...\r\n";
echo "<br>\r\n";
echo "Result = ";
echo ser_read();

 ?>

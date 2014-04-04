<?php

$ip="localhost";
$nu="root";
$psw="";
 
$conn=mysql_connect($ip,$nu,$psw);

	if($conn==false)
		die ("Non posso connettermi.");
		
//echo "Connessione riuscita";

$db=mysql_select_db("areadiprogetto");

	if($db==false)
		echo"il database non esiste.";

//echo", ok. ";

?>

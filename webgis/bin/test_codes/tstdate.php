<?php
       
 $host="localhost";
$user="root";
$password="";
// echo $_POST['shutdownlayer'] ;

$con=mysql_connect($host,$user,$password) or die(mysql_error());
//mysql_query("CREATE DATABASE onemmore");
$db=mysql_select_db("shutdown_places",$con) or die("Failed to connect to MySQL: " . mysql_error());

	$raw="2022-07-07T13:45:50";
	$xplod = explode('T', $raw);
 
	print_r($xplod);
 
	$string = "$xplod[0] $xplod[1]";
 
	echo "<br />$string";
 
	$date = date("Y-m-d H:i:s", strtotime($string));
 
	echo "<br />$date";
	if(mysql_query("INSERT INTO Shutdown(endshutdown)VALUES('$date')"))
		echo "Inserted successfully!";
	else
		echo "Failed .. please try again!";
 

?>
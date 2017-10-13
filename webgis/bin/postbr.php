<?php 
$host="localhost";
$user="root";
$password="12345678";
// echo $_POST['shutdownlayer'] ;

$con=mysql_connect($host,$user,$password) or die(mysql_error());
//mysql_query("CREATE DATABASE onemmore");
$db=mysql_select_db("shutdown_places",$con) or die("Failed to connect to MySQL: " . mysql_error());
//inserting Record to the database
$name = mysql_real_escape_string($_POST['brname']);

$desc = mysql_real_escape_string($_POST['brdescr']);
$lat =mysql_real_escape_string($_POST['brlat']);
$lng =mysql_real_escape_string($_POST['brlng']);
$brtime=mysql_real_escape_string($_POST['brtime']);
$adder=mysql_real_escape_string($_POST['adder']);
// $email = $_POST['email'];
// $message =  $_POST['message'];

$query = "INSERT INTO Bird(brname,description,bradder,brtime,brlat,brlng)VALUES('$name','$desc','$adder','$brtime','$lat','$lng')";
// $query = "INSERT INTO Eventloc(eventname)VALUES('$name')";

$result = mysql_query($query);
if($result)
	{
	    echo "Successfully added 1 creature!";
	}
	else
	{
	 die('Error: '.mysql_error($con));
	}
	mysql_close($con);

     
?>


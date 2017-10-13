<?php 
$host="localhost";
$user="root";
$password="12345678";
// echo $_POST['shutdownlayer'] ;

$con=mysql_connect($host,$user,$password) or die(mysql_error());
//mysql_query("CREATE DATABASE onemmore");
$db=mysql_select_db("shutdown_places",$con) or die("Failed to connect to MySQL: " . mysql_error());
//inserting Record to the database
$name = mysql_real_escape_string($_POST['eventname']);

$desc = mysql_real_escape_string($_POST['eventdescr']);
$evlocid = $_POST['evid'];
$evlocation =mysql_real_escape_string($_POST['evlocation']);
$evstrt=mysql_real_escape_string($_POST['eventstart']);
$evend =mysql_real_escape_string($_POST['eventend']);
$evadder=mysql_real_escape_string($_POST['adder']);
// $email = $_POST['email'];
// $message =  $_POST['message'];

$query = "INSERT INTO Eventloc(eventname,description,idloc,location, adder,eventstart,eventend)VALUES('$name','$desc','$evlocid','$evlocation','$evadder','$evstrt','$evend')";
// $query = "INSERT INTO Eventloc(eventname)VALUES('$name')";

$result = mysql_query($query);
if($result)
	{
	    echo "Successfully added 1 event!";
	}
	else
	{
	 die('Error: '.mysql_error($con));
	}
	mysql_close($con);

     
?>


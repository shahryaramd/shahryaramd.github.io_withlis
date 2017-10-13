<?php 
$host="localhost";
$user="root";
$password="12345678";
// echo $_POST['shutdownlayer'] ;

$con=mysql_connect($host,$user,$password) or die(mysql_error());
//mysql_query("CREATE DATABASE onemmore");
$db=mysql_select_db("shutdown_places",$con) or die("Failed to connect to MySQL: " . mysql_error());
//inserting Record to the database
$name = mysql_real_escape_string($_POST['objname']);

$desc = mysql_real_escape_string($_POST['objdescr']);
$objlocid = $_POST['objid'];
$objlocation =mysql_real_escape_string($_POST['objlocation']);
$objtime=mysql_real_escape_string($_POST['objtime']);
$objsel =mysql_real_escape_string($_POST['objsel']);
$objadder=mysql_real_escape_string($_POST['adder']);
$objaddress=mysql_real_escape_string($_POST['address']);
// $email = $_POST['email'];
// $message =  $_POST['message'];

$query = "INSERT INTO Lostfound(objname,description,idloc,location, adder,address, objtime,objsel)VALUES('$name','$desc','$objlocid','$objlocation','$objadder','$objaddress','$objtime','$objsel')";
// $query = "INSERT INTO Eventloc(eventname)VALUES('$name')";

$result = mysql_query($query);
if($result)
	{
	    echo "Successfully added 1 object!";
	}
	else
	{
	 die('Error: '.mysql_error($con));
	}
	mysql_close($con);

     
?>


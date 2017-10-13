<?php 
$host="localhost";
$user="root";
$password="12345678";
// echo $_POST['shutdownlayer'] ;

$con=mysql_connect($host,$user,$password) or die(mysql_error());
//mysql_query("CREATE DATABASE onemmore");
$db=mysql_select_db("shutdown_places",$con) or die("Failed to connect to MySQL: " . mysql_error());
//inserting Record to the database
$nameid = mysql_real_escape_string($_POST['shutdownlayer']);
$desc = mysql_real_escape_string($_POST['description']);
$detail=mysql_real_escape_string($_POST['shutdesc']);
$featname=$_POST['featname'];
$shutstr =mysql_real_escape_string($_POST['shutstr']);
$shutend =mysql_real_escape_string($_POST['shutend']);
// $email = $_POST['email'];
// $message =  $_POST['message'];

$query = "INSERT INTO Shutdown(description,layerfeat,featname,detail,strtshutdown,endshutdown)VALUES('$desc','$nameid','$featname','$detail','$shutstr','$shutend')";
$result = mysql_query($query);
if($result)
	{
	    echo "Successfully entered information!";
	}
	else
	{
	 die('Error: '.mysql_error($con));
	}
	mysql_close($con);

     
?>


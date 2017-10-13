<?php 
$host="localhost";
$user="root";
$password="12345678";
// echo $_POST['shutdownlayer'] ;

$con=mysql_connect($host,$user,$password) or die(mysql_error());
//mysql_query("CREATE DATABASE onemmore");
$db=mysql_select_db("shutdown_places",$con) or die("Failed to connect to MySQL: " . mysql_error());
// $sel="1";
// $sel=$_POST['answer'];

// First delete shutdowns where end date passed
$sqldel="DELETE FROM `Eventloc` WHERE `eventend` < NOW()";
mysql_query($sqldel);

// Now select event places
 $strsql = "SELECT * FROM `Eventloc`";
// Execute the query (the recordset $rs contains the result)
$rs = mysql_query($strsql);
// Each row will be made into an array ($row) using mysql_fetch_array
while($row = mysql_fetch_array($rs)) {
  
  // echo $row['layerfeat'] . "|";
  $cast[] =  array('eventname' => $row['eventname']. "|", 'description' => $row['description']. "|",'id' => $row['idloc']. "|", 'adder' => $row['adder']. "|",  'eventstart' => $row['eventstart']. "|", 'eventend' => $row['eventend']. "|");
}
foreach($cast as $row) {
    echo $row['id'];
}
echo "___";
foreach($cast as $row) {
    echo $row['eventname'];
}
echo "___";
foreach($cast as $row) {
    echo $row['description'];
}
echo "___";
foreach($cast as $row) {
    echo $row['eventstart'];
}
echo "___";
foreach($cast as $row) {
    echo $row['eventend'];
}
echo "___";
foreach($cast as $row) {
    echo $row['adder'];
}
// Close the database connection
mysql_close();
?>
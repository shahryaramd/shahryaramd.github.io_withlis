<?php 
$host="localhost";
$user="root";
$password="12345678";
// echo $_POST['shutdownlayer'] ;

$con=mysql_connect($host,$user,$password) or die(mysql_error());
//mysql_query("CREATE DATABASE onemmore");
$db=mysql_select_db("shutdown_places",$con) or die("Failed to connect to MySQL: " . mysql_error());

// First delete shutdowns where end date passed
// $sqldel="DELETE FROM `Lostfound` WHERE `removetime` < NOW()";
// mysql_query($sqldel);

// Now select event places
$strsql = "SELECT * FROM `Bird`";
// Execute the query (the recordset $rs contains the result)
$rs = mysql_query($strsql);
// Each row will be made into an array ($row) using mysql_fetch_array
while($row = mysql_fetch_array($rs)) {

 // brname,description,bradder,brtime,brlat,brlng
$cast[] =  array('brname' => $row['brname']. "|", 'description' => $row['description']. "|", 'adder' => $row['bradder']. "|", 'brtime' => $row['brtime']. "|", 'brlat' => $row['brlat']. "|", 'brlng' => $row['brlng']. "|");
}

foreach($cast as $row) {
    echo $row['brname'];
}
echo "___";
foreach($cast as $row) {
    echo $row['description'];
}
echo "___";
foreach($cast as $row) {
    echo $row['brtime'];
}
echo "___";
foreach($cast as $row) {
    echo $row['adder'];
}
echo "___";
foreach($cast as $row) {
    echo $row['brlat'];
}
echo "___";
foreach($cast as $row) {
    echo $row['brlng'];
}
// Close the database connection
mysql_close();
?>
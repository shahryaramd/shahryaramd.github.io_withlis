<?php 
$host="localhost";
$user="root";
$password="12345678";
// echo $_POST['shutdownlayer'] ;

$con=mysql_connect($host,$user,$password) or die(mysql_error());
//mysql_query("CREATE DATABASE onemmore");
$db=mysql_select_db("shutdown_places",$con) or die("Failed to connect to MySQL: " . mysql_error());
// $sel="1";
$sel=$_POST['answer'];

// First delete shutdowns where end date passed
$sqldel="DELETE FROM `Lostfound` WHERE `removetime` < NOW()";
mysql_query($sqldel);

// Now select event places
switch ($sel) {
	case '1':
		$strsql = "SELECT * FROM `Lostfound` WHERE `objsel`=1";
		break;
	case '2':
		$strsql = "SELECT * FROM `Lostfound` WHERE `objsel`=2";
		break;
	default:
		$strsql = "SELECT * FROM `Lostfound`";
		break;
}
 // $strsql = "SELECT * FROM `Lostfound`";
// Execute the query (the recordset $rs contains the result)
$rs = mysql_query($strsql);
// Each row will be made into an array ($row) using mysql_fetch_array
while($row = mysql_fetch_array($rs)) {
  
  // echo $row['layerfeat'] . "|";
  $cast[] =  array('objname' => $row['objname']. "|", 'description' => $row['description']. "|",'id' => $row['idloc']. "|", 'adder' => $row['adder']. "|",'address' => $row['address']. "|",  'objtime' => $row['objtime']. "|", 'objsel' => $row['objsel']. "|");
}
foreach($cast as $row) {
    echo $row['id'];
}
echo "___";
foreach($cast as $row) {
    echo $row['objname'];
}
echo "___";
foreach($cast as $row) {
    echo $row['description'];
}
echo "___";
foreach($cast as $row) {
    echo $row['objtime'];
}
echo "___";
foreach($cast as $row) {
    echo $row['adder'];
}
echo "___";
foreach($cast as $row) {
    echo $row['address'];
}
echo "___";
foreach($cast as $row) {
    echo $row['objsel'];
}
// Close the database connection
mysql_close();
?>
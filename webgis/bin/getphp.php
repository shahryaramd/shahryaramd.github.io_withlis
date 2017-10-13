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
$sqldel="DELETE FROM Shutdown WHERE `endshutdown` < NOW()";
mysql_query($sqldel);

// Now select shutdown places as required
switch ($sel) {
    case "1":
        $strsql = "SELECT * FROM `Shutdown` WHERE description = 1";
        break;
    case "2":
        $strsql = "SELECT * FROM `Shutdown` WHERE description = 2";
        break;
    case "3":
        $strsql = "SELECT * FROM `Shutdown` WHERE description = 3";
        break;
    case "4":
        $strsql = "SELECT * FROM `Shutdown` WHERE description = 4";
        break;
    default:
        $strsql = "SELECT * FROM `Shutdown`";
}
// Execute the query (the recordset $rs contains the result)
$rs = mysql_query($strsql);
// Each row will be made into an array ($row) using mysql_fetch_array
while($row = mysql_fetch_array($rs)) {
  
  // echo $row['layerfeat'] . "|";
  $cast[] =  array('id' => $row['layerfeat']. "|", 'shutdetail' => $row['detail']. "|",'strdate' => $row['strtshutdown']. "|",'enddate' => $row['endshutdown']. "|");
  // echo json_encode($cast,JSON_FORCE_OBJECT);
  }
foreach($cast as $row) {
    echo $row['id'];
}
echo "___";
foreach($cast as $row) {
    echo $row['shutdetail'];
}
echo "___";
foreach($cast as $row) {
    echo $row['strdate'];
}
echo "___";
foreach($cast as $row) {
    echo $row['enddate'];
}
// Close the database connection
mysql_close();
?>
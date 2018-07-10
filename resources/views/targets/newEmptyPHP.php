<?php
include_once('databaseconnect.php');

$sql="select * from Login_Master";
$result=mysqli_query($link, $sql);

$data=mysqli_fetch_array($result);
print_r($data);
//exit();


$msg="";
if($_SERVER['REQUEST_METHOD'] == "GET")
{

$sql_load="select NOW() as 'dt' ;";
$return_load=mysql_query( $sql_load);
while($row = mysql_fetch_array($return_load)) 
{
	extract($row);
	$result[] = array("dt" => $dt);
} 



}
else
{
	$result = array("status" => 0, "msg" => "Request method not accepted!");
}
@mysql_close($conn);

/* Output header */
header('Content-type: application/json');
// Returns the JSON representation of fetched data
print(json_encode($result));
?>
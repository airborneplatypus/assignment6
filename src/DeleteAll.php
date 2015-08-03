<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//mysqli_report(MYSQLI_REPORT_ALL);

$dbhost = 'oniddb.cws.oregonstate.edu';
$dbname = 'koistint-db';
$dbuser = 'koistint-db';
$dbpass = '48W7fqmF2hJOtdFA';


$mysqli_handle = mysqli_connect($dbhost, $dbuser, $dbpass)
	or die("Error connecting to database server");

mysqli_select_db($mysqli_handle, $dbname)
	or die("Error selecting database: $dbname");

//echo 'Successfully connected to database!';

$search = json_decode(file_get_contents('php://input'));

if(isset($search)){
	$stmt = $mysqli_handle->prepare("DELET * FROM cs290assign9");
	if(!($stmt->execute())){
		echo ("Could not delete data : " . mysqli_error($mysqli_handle));// . " " . mysqli_errno($mysqli_handle)
	}
}



?>
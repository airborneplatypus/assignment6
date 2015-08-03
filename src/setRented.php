<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$dbhost = 'oniddb.cws.oregonstate.edu';
$dbname = 'koistint-db';
$dbuser = 'koistint-db';
$dbpass = '48W7fqmF2hJOtdFA';


$mysqli_handle = mysqli_connect($dbhost, $dbuser, $dbpass)
	or die("Error connecting to database server");

mysqli_select_db($mysqli_handle, $dbname)
	or die("Error selecting database: $dbname");

//echo 'Successfully connected to database!';

$receive = json_decode(file_get_contents('php://input'));

if(isset($receive)){
	$id = $receive->id;
	$rentStatus = $receive->rentStatus;
	echo $id;
	echo $rentStatus;
	$stmt = $mysqli_handle->prepare("UPDATE cs290assign6 SET rented = ? WHERE id = ?");
	//var_dump($stmt);
	if ($stmt) {
		echo "success";
		$stmt->bind_param("ii", $rentStatus ,$id);
		$stmt->execute();
	} else {
		echo ("Could not insert data : " . mysqli_error($mysqli_handle));// . " " . mysqli_errno($mysqli_handle)
	}
}

mysqli_close($mysqli_handle);
?>
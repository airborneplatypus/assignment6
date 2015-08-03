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

$new_movie = json_decode(file_get_contents('php://input'));

if(isset($new_movie)){
	$movieName = $new_movie->name;
	$movieCategory = $new_movie->category;
	$movieLength = $new_movie->movieLength;
	if($new_movie->rented == "on"){
		$rented = true;
	} else{
		$rented = false;
	}
	$stmt = $mysqli_handle->prepare("INSERT INTO cs290assign6 ( name, category, length, rented) VALUES( ?, ?, ?, ?)");
	$stmt->bind_param("sssb", $movieName, $movieCategory, $movieLength, $rented);
	$result = $stmt->execute();
    if ($result) {
        echo "success";
    } else {
        echo ("Could not insert data : " . mysqli_error($mysqli_handle));// . " " . mysqli_errno($mysqli_handle)
    }
}

mysqli_close($mysqli_handle);
?>
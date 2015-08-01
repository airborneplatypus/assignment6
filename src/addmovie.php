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

echo 'Successfully connected to database!';



$new_movie = json_decode(file_get_contents('php://input'));
//var_dump($new_movie);
//var_dump($new_movie->name);
//echo $new_movie->name;

if(isset($new_movie)){
	$name = $new_movie->name;
	$category = $new_movie->category;
	$movieLength = $new_movie->movieLength;
	$sql = "INSERT INTO cs290assign6 ( name, category, length) VALUES( $name, $category, $movieLength)";
	mysqli_query($mysqli_handle ,$sql);
}

mysqli_close($mysqli_handle);
?>
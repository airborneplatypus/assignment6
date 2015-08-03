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
	$movieCategory = $search->category;
	$stmt = $mysqli_handle->prepare("SELECT * FROM cs290assign6 WHERE category = ?");
	$stmt->bind_param("s", $movieCategory);
	if(!($stmt->execute())){
		echo ("Could not insert data : " . mysqli_error($mysqli_handle));// . " " . mysqli_errno($mysqli_handle)
	}
	else{
		$result = $stmt->get_result();
		$response = [];
		while($row = $result->fetch_array(MYSQLI_NUM)){
			$current_row = [];
			$current_row['id'] = $row[0];
			$current_row['name'] = $row[1];
			$current_row['category'] = $row[2];
			$current_row['length'] = $row[3];
			$current_row['rented'] = $row[4];
			$response[] = $current_row;
		}
		echo json_encode($response);
	}
	
	$stmt->close();
}

mysqli_close($mysqli_handle);
?>

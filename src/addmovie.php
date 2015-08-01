<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$dbhost = 'oniddb.cws.oregonstate.edu';
$dbname = 'koistint-db';
$dbuser = 'koistint-db';
$dbpass = '48W7fqmF2hJOtdFA';

echo "responding";

$mysqli_handle = mysqli_connect($dbhost, $dbuser, $dbpass)
	or die("Error connecting to database server");

mysqli_select_db($mysqli_handle, $dbname)
	or die("Error selecting database: $dbname");

echo 'Successfully connected to database!';

mysqli_close($mysqli_handle);

$new_movie = json_decode(file_get_contents('php://input'));

/*if(isset($new_movie)){
	if ($_POST['username'] == null || strlen($_POST['username']) == 0) {
		echo "<center>";
		echo "A username must be entered. Click <a href=\"login.php\">here</a> to return to the login screen.";
		echo "</center>";
		$nulluser = 1;
	}
	else{
		$_SESSION['visited'] = 0;
		$_SESSION["loggedIn"] = 1;
		$_SESSION["username"] = $_POST['username'];
	}
}
?>*/
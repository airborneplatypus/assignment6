<?php
//first you want to create a folder called db and put this file in it 

//then in your index file type this in 
/*
require 'db/connect.php';
*/
//if this doesn't work please update with proper credintials 
$db = new mysqli('oniddb.cws.oregonstate.edu', 'koistint-db', '48W7fqmF2hJOtdFA', 'koinstint-db(1)');

echo $db->connect_errno;

if($db->connect_errno){
	die("Error on connecting to database");
}

//Now you can use db as a variable in your index

//Type this in your index to return some data:
/********
error_reporting(0);
require 'db/connect.php';

if($result = $db->query("SELECT * FROM cs290assign6")){
	if($result->num_rows){
		$rows = $result->fetch_assoc();
		echo '<pre>', print_r($rows), '</pre>';
	}
}
*///******

//This will put all your data in a readable fashion. There are some other methods to putting it into html
//But you should use the db variable to query 

?>
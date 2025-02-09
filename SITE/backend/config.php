<?php
$server="localhost";
$dbname="bluejack";
$username="";
$password="";

try{
	$connection = new PDO("mysql:host=$server;dbname=$dbname", $username, $password); 
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// echo "Success!";
} catch (PDOException $e){
	
	echo "Failed to connect to database...<br>";
	// echo $e->getMessage(); // For a further log
}


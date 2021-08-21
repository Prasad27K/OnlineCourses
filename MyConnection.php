<?php
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
	$servername = "165.22.14.77";
	$username = "b27";
	$password = "b27";
	$dbName = "syllabusDB";

	$conn = mysqli_connect($servername, $username, $password, $dbName);
?>
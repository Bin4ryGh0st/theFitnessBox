<?php
	$conn = new mysqli("localhost","tfbRoot","toorBft","theFitnessBox");
	if ($conn->connect_error) 
	{
		echo "Connection Failed!!<br>";
    	die("Connection failed: " . $conn->connect_error);
	}
?>

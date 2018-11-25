<?php
	include "/var/www/html/theFitnessBox/php/mainDBConnect.php";
	//$conn = new mysqli("localhost","tfbRoot","toorBft","theFitnessBox");
	$email=$_POST["email"];
	$sql="SELECT email FROM theFitnessBox.user WHERE email='$email';";
	$res = $conn->query($sql);
	if($res->num_rows>0)
	{
		echo "true";
	}
	else
	{
		echo "false";
	}
?>

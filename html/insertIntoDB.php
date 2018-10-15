<?php
	//include "/var/www/html/theFitnessBox/php/mainDBConnect.php";
	$conn = new mysqli("localhost","tfbRoot","toorBft","theFitnessBox");
	$n=$_POST["n"];
	$e=$_POST["e"];
	$d=$_POST["d"];
	$g=$_POST["g"];
	$b=$_POST["b"];
	$p=$_POST["p"];
	$sql="INSERT INTO user (name,email,dob,gender,bmi,password) VALUES ('$n','$e','$d','$g',$b,'$p');";
	echo $sql;
	if($conn->query($sql))
	{
		echo "yes";
	}
	else
	{
		echo "no";
	}
?>

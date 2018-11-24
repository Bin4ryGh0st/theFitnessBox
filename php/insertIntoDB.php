<?php
	include "mainDBConnect.php";
	session_start();
	//$conn = new mysqli("localhost","tfbRoot","toorBft","theFitnessBox");
	$n=$_POST["signupName"];
	$e=$_POST["signupEmail"];
	$d=$_POST["signupDOB"];
	$g=$_POST["signupGender"];
	$b=$_POST["signupBMI"];
	$p=hash('sha256', $_POST["signupPassword"]);
	/*$n="Kaushal Bhansali";
	$e="kaushal.bhansali@gmail.com";
	$d="2001-03-05";
	$g="m";                                     //For Debugging
	$b=28;
	$p=hash('sha256', "123456789");
	*/
	$sql="INSERT INTO user (name,email,dob,gender,bmi,password) VALUES ('$n','$e','$d','$g',$b,'$p');";
	//echo $sql;
	if($conn->query($sql))
	{
		//echo "\nyes";
		$_SESSION['email']=$e;
		header('Location: http://localhost/theFitnessBox/php/loggedIn.php');
		exit;
	}
	else
	{
		session_destroy();
		echo "\nUnexpected Error Occured!!";
	}
?>

<?php
	//print_r($_POST);
	//echo $_POST[newBlogContent];
	session_start();
	if($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['email'])
	{
		include "mainDBConnect.php";
		$title = htmlspecialchars(str_replace("\"","'",$_POST['newDietPlanTitle']));
		$content = htmlspecialchars(str_replace("\"","'",$_POST['newDietPlanContent']));
		//echo $title . $content;
		//print_r($_POST);
		$email = $_SESSION['email'];
		$date = date("Y-m-d");
		$sql = "INSERT INTO dietPlans values('$email','$date',$title,\"$content\");";
		$conn->query($sql);
		header("Location: http://localhost/theFitnessBox/php/dietPlans.php");
		exit;
	}
	else
	{
		echo "<h1>Permission Denied!!<h1>";
		session_destroy();
		exit;
	}
?>

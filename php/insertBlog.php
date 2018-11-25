<?php
	//print_r($_POST);
	//echo $_POST[newBlogContent];
	session_start();
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		include "mainDBConnect.php";
		$title = htmlspecialchars(str_replace("\"","'",$_POST['newBlogTitle']));
		$content = htmlspecialchars(str_replace("\"","'",$_POST['newBlogContent']));
		//echo $title . $content;
		//print_r($_POST);
		$email = $_SESSION['email'];
		$date = date("Y-m-d");
		$sql = "INSERT INTO blogs values('$email','$date','$title',\"$content\");";
		$conn->query($sql);
		header("Location: http://localhost/theFitnessBox/php/blogs.php");
		exit;
	}
	else
	{
		echo "<h1>Permission Denied!!<h1>";
		session_destroy();
		exit;
	}
?>

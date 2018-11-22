<html>
	<head>
		<?php	
			session_start();
			//echo 0 . "<br>";
			include "mainDBConnect.php";
			//echo 1 . "<br>";
			if($_SERVER["REQUEST_METHOD"] == "POST")
			{
				//echo 2 . "<br>";
				$email = $_POST['loginEmail'] ;
				$pass = hash('sha256', $_POST['loginPassword']);
				$sql = "SELECT email FROM user WHERE email= '$email' and password='$pass';";
				$r = $conn->query($sql);
				if( $r->num_rows > 0)
				{
					//echo "\nyes"; 
					$_SESSION['email']=$email;
				}	
				else
				{
					session_destroy();
					echo "<br>Wrong Email Or Password!!<br>";
					exit;
				}
			}
			elseif(!sizeof($_SESSION))
			{
				session_destroy();
				echo "<br>Permission Denied!!<br>";
				exit;
			}
			//print_r($_SESSION);
			//exit;
			//echo "<br>";
			//print_r($_SESSION);
		?>
		<link rel="stylesheet" type="text/css" href="http://localhost/theFitnessBox/css/main.css" />
	</head>
	
	<body bgcolor="#000000">
		<div class= "packHomeMenu">
			<a href="http://localhost/theFitnessBox/html/main.html"><img src="http://localhost/theFitnessBox/images/tfbLogo.png" width=240 height=40></a>
			<div class="homeMenu">
				<input class="customButtonSelected" type="button" id="" value="button" onclick="">
				<input class="customButton" type="button" id="" value="button" onclick="">
				<input class="customButton" type="button" id="" value="button" onclick="">
				<input class="customButton" type="button" id="" value="button" onclick="">
				<input class="customButton" type="button" id="logOut" value="logout" onclick="location.href = 'http://localhost/theFitnessBox/php/logout.php'">
			</div>
		</div> 
	</body>
</html>

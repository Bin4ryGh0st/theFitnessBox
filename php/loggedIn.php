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
					echo "<h1>Incorrect Credentials!!<h1>";
					exit;
				}
			}
			elseif(!sizeof($_SESSION))
			{
				session_destroy();
				echo "<h1>Permission Denied!!<h1>";
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
			<a href="http://localhost/theFitnessBox/php/loggedIn.php"><img src="http://localhost/theFitnessBox/images/tfbLogo.png" width=240 height=40></a>
			<div class="homeMenu">
				<input class="customButtonSelected" type="button" id="My Profile" value="My Profile" onclick="location.href = 'http://localhost/theFitnessBox/php/loggedIn.php'">
				<input class="customButton" type="button" id="Blogs" value="Blogs" onclick="location.href = 'http://localhost/theFitnessBox/php/blogs.php'">
				<input class="customButton" type="button" id="Shop" value="Shop" onclick="location.href = 'http://localhost/theFitnessBox/php/products.php'">
				<input class="customButton" type="button" id="Diet Plans" value="Diet Plans" onclick="">
				<input class="customButton" type="button" id="logOut" value="logout" onclick="location.href = 'http://localhost/theFitnessBox/php/logout.php'">
			</div>
		</div> 
		
		
	</body>
</html>

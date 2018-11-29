<html>
	<head>
		<?php	
			session_start();
			//echo 0 . "<br>";
			//echo 1 . "<br>";
			
			if($_SERVER["REQUEST_METHOD"] == "POST")
			{
				include "mainDBConnect.php";
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
			elseif(!$_SESSION['email'])
			{
				session_destroy();
				echo "<h1>Permission Denied!!<h1>";
				exit;
			}
			
			//print_r($_SESSION);
			//exit;
			//echo "<br>";
			//print_r($_SESSION);
			//$_SESSION['email']='kaushal.bhansali2@gmail.com';
		?>
		<link rel="stylesheet" type="text/css" href="http://localhost/theFitnessBox/css/main.css" />
		<link rel="stylesheet" type="text/css" href="http://localhost/theFitnessBox/css/loggedIn.css" />
	</head>
	
	<body bgcolor="#000000">
		<div class= "packHomeMenu">
			<a href="http://localhost/theFitnessBox/php/loggedIn.php"><img src="http://localhost/theFitnessBox/images/tfbLogo.png" width=240 height=40></a>
			<div class="homeMenu">
				<input class="customButtonSelected" type="button" id="My Profile" value="My Profile" onclick="location.href = 'http://localhost/theFitnessBox/php/loggedIn.php'">
				<input class="customButton" type="button" id="Blogs" value="Blogs" onclick="location.href = 'http://localhost/theFitnessBox/php/blogs.php'">
				<input class="customButton" type="button" id="Shop" value="Shop" onclick="location.href = 'http://localhost/theFitnessBox/php/products.php'">
				<input class="customButton" type="button" id="Diet Plans" value="Diet Plans" onclick="location.href = 'http://localhost/theFitnessBox/php/dietPlans.php'">
				<input class="customButton" type="button" id="logOut" value="logout" onclick="location.href = 'http://localhost/theFitnessBox/php/logout.php'">
			</div>
		</div> 
		<center class='golden'>
			<?php
				include "mainDBConnect.php";
				$sql="SELECT name FROM user WHERE email='" . $_SESSION['email'] . "';";
				$r = $conn->query($sql);
				$row=$r->fetch_assoc();
				echo "<h1>Welcome " . $row['name'] . ",</h1>";
			?>
			<h2 >Your Timeline with us :</h2>
			<span><h3><u>Your order history :</u></h3></span>
			<span>Date of purchase:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Order Id:</span>
			<br><br>
		</center>
		<?php
			include "mainDBConnect.php";
			$sql="SELECT dateOfPurchase,orderID FROM purchaseHistory WHERE email='" . $_SESSION[email] . "' ORDER BY dateOfPurchase desc;";
			//echo($sql);
			$r = $conn->query($sql);
			//print_r($r);
			if($r->num_rows<=0)
			{
				echo "<center class='red'>";
					echo "<span><b>You haven't purchased anything yet.</b></span>";
					echo "<br><br>";
					echo "<input type='button' value='Shop for First time' class='customButton' onclick=\"location.href = 'http://localhost/theFitnessBox/php/products.php'\">";
				echo "</center>";
			}
			else
			{	
				while($row=$r->fetch_assoc())
				{
					echo "<span class='fetchedContent'>";
						echo "<span class='fdop'>" . $row['dateOfPurchase'] ."</span>";
						echo "<a href = http://localhost/theFitnessBox/php/selectionSummary.php?orderID=". $row['orderID'] .">";
						echo "	<span class='foid'>#" . $row['orderID'] ."</span>";
						echo "</a>";
					echo "</span>";
					echo "<br>"; 
				}
			}
			echo "<br>";
		?>
		<center class='golden'>
			<span><h3><u>Your Blog Posts :</u></h3></span>
			<span>Date of Posting&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Topic of the blog<span>
		</center>
		<br>
		<?php
			$sql="SELECT dateOfPublishing,topic FROM blogs WHERE authorEmail='" . $_SESSION['email'] . "' ORDER BY dateOfPublishing desc;";
			$r=$conn->query($sql);
			if($r->num_rows>0)
			{
				while($row=$r->fetch_assoc())
				{
					$topic = str_replace(' ', '-', $row['topic']);;
					echo "<span class='fetchedContent'>";
						echo "<span class='fdop'>" . $row['dateOfPublishing'] ."</span>";
						echo "<a href = http://localhost/theFitnessBox/php/selectionSummary.php?blogDate=" . $row['dateOfPublishing'] ."&blogTopic=" . $topic . ">";
						echo "	<span class='foid'>" . $row['topic'] ."</span>";
						echo "</a>";
						//print_r($topic);
					echo "</span>";
					echo "<br>"; 
				}
			}
			else
			{
				echo "<center class='red'>";
					echo "<span><b>You haven't posted anything yet.</b></span>";
					echo "<br><br>";
					echo "<input type='button' value='Write Your First Blog' class='customButton' onclick=\"location.href = 'http://localhost/theFitnessBox/php/blogs.php'\">";
				echo "</center>";
			}
		?>
	</body>
</html>

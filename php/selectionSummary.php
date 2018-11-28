<html>
	<head>
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
	</head>
	
	<body bgcolor="#000000"> 
		<?php
			session_start();
			if($_SERVER["REQUEST_METHOD"] == "GET" && $_SESSION['email'])
			{
				echo "<link rel='stylesheet' type='text/css' href='http://localhost/theFitnessBox/css/main.css' />";
				echo "<link rel='stylesheet' type='text/css' href='http://localhost/theFitnessBox/css/products.css' />";
				echo "<br>";
				echo "<span class='cartHeading'><h2>Order ID : #". $_GET[orderID]. "</h2></span>";
				//print_r($_GET);
				include "mainDBConnect.php";
				//echo $_GET[orderID];
				$sql1="SELECT * FROM products p WHERE p.productID IN (SELECT productID FROM purchaseDetails WHERE orderID='" . $_GET[orderID] . "');";
				//echo $sql1;
				$r=$conn->query($sql1);
				//echo $r->num_rows;
				//echo $conn->connect_error;
				//print_r($r);
				$totalPrice = 0;
				echo "<span class='bill'>";
						echo "<span style='position:absolute;' > Product Id </span>" ;
						echo "<span class ='billPName' >Product</span>" ;
						echo "<span class ='billPPrice' > Cost</span>" ;
						echo "<br><br>";
				echo "</span>";
				while($row = $r->fetch_assoc())
				{
					echo "<span class='bill'>";
						echo "<span class ='billPID' >" .$row['productID'] . "</span>" ;
						echo "<span class ='billPName' >" .$row['productName'] . "</span>" ;
						echo "<span class ='billPPrice' >" .$row['price'] . " INR.</span>" ;
						echo "<br>";
					echo "</span>";
					$totalPrice+=$row['price'];
				}
				echo "<span style='color:#ffd700'>
					-----------------------------------------------------------------------------------------------------------------------------------
				</span>";
				echo "<br>";
				echo "<span class ='bill billPName'>";
				echo "Total :";
				echo "</span>";
				echo "<span class ='bill billPPrice'>";
				echo	$totalPrice . " INR.";
				echo "</span>";
				echo "<br><br>";
				echo "<input type='button' class='customButton' style='position:absolute; left:28%;' value='Back to home' onclick=\"location.href = 'http://localhost/theFitnessBox/php/loggedIn.php'\">";
			}
			else
			{
				echo "<h1>Permission Denied!!<h1>";
				session_destroy();
				exit;
			}
		?> 
	</body>
</html>

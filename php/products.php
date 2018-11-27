<html>
	<head>
		<?php
			session_start();
			if(!$_SESSION['email'])
			{
				session_destroy();
				echo "<h1>Permission Denied!!</h1>";
				exit;
			}
		?>
		<link rel="stylesheet" type="text/css" href="http://localhost/theFitnessBox/css/main.css" />
		<link rel="stylesheet" type="text/css" href="http://localhost/theFitnessBox/css/products.css" />
		<script src="http://localhost/theFitnessBox/js/products.js"></script>
	</head>
	<body bgcolor="#000000">
		<div class= "packHomeMenu">
			<a href="http://localhost/theFitnessBox/php/loggedIn.php"><img src="http://localhost/theFitnessBox/images/tfbLogo.png" width=240 height=40></a>
			<div class="homeMenu">
				<input class="customButton" type="button" id="My Profile" value="My Profile" onclick="location.href = 'http://localhost/theFitnessBox/php/loggedIn.php'">
				<input class="customButton" type="button" id="Blogs" value="Blogs" onclick="location.href = 'http://localhost/theFitnessBox/php/blogs.php'">
				<input class="customButtonSelected" type="button" id="Shop" value="Shop" onclick="location.href = 'http://localhost/theFitnessBox/php/products.php'">
				<input class="customButton" type="button" id="Diet Plans" value="Diet Plans" onclick="">
				<input class="customButton" type="button" id="logOut" value="logout" onclick="location.href = 'http://localhost/theFitnessBox/php/logout.php'">
			</div>
		</div> 
		<br>
		<?php
			include "mainDBConnect.php";
			//$sql = "insert into products (productID) values (2);";
			//$conn->query($sql);
			//echo $conn->connect_error;
			$sql = "select * from products;";
			$r = $conn->query($sql);

			while($row = $r->fetch_assoc())
			{ 
				echo "<div class='fullRow'>";
					echo "<p>";
						echo "<div class='Row leftRow'>";	
							echo "<img src=\"" . $row['productPicture'] . "\" align='left'>" ;
							echo "<br><br>";
							echo "<span>";
								echo "<u>Product</u> : " . $row['productName'];
							echo "</span>";
							echo "<br><br>";
							echo "<span>";		
								echo "<u>Price</u> : " . $row['price'] . " INR.";
							echo "</span>";	
							echo "<br><br>";
							echo "<span>";		
								echo "<sup>A product by : " . $row['brand'] . "</sup>";
							echo "</span>";	
							/*echo "<br><br>";
							echo "<span>";		
								echo "<u>Double of Quantity Remaining: " . ($row['stockQuantity']+$row['stockQuantity']) . "</u>";
							echo "</span>";*/
							if($row['stockQuantity'] > 0)
							{
								echo "<br><br>";
								echo "<input type='button' value='Add to Cart' id='$row[productID]' class='customButton alignButton'>";
							}
							else
							{
								echo "<br><br>";
								echo "<input type='button' value='Out of Stock' class='customButton alignButton' onclick='outOfStock()'>";
							}
							
						echo "</div>";
					echo "</p>";
				if($row = $r->fetch_assoc())
				{
					echo "<p>";
						echo "<div class='Row rightRow'>";	
							echo "<img src=\"" . $row['productPicture'] . "\" align='left'>" ;
							echo "<br><br>";
							echo "<span>";
								echo "<u>Product</u> : " . $row['productName'];
							echo "</span>";
							echo "<br><br>";
							echo "<span>";		
								echo "<u>Price</u> : " . $row['price'] . " INR.";
							echo "</span>";	
							echo "<br><br>";
							echo "<span>";		
								echo "<sup>A product by : " . $row['brand'] . "</sup>";
							echo "</span>";	
							/*echo "<br><br>";
							echo "<span>";		
								echo "<u>Double of Quantity Remaining: " . ($row['stockQuantity']+$row['stockQuantity']) . "</u>";
							echo "</span>";*/
							if($row['stockQuantity'] > 0)
							{
								echo "<br><br>";
								echo "<input type='button' value='Add to Cart' id='$row[productID]' class='customButton alignButton'>";
							}
							else
							{
								echo "<br><br>";
								echo "<input type='button' value='Out of Stock' class='customButton alignButton' onclick='outOfStock()'>";
							}
							
						echo "</div>";
					echo "</p>";
				}		
				echo "</div>";
			}
		?>
	</body>
</html>

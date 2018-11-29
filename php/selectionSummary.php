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
				echo '<link rel="stylesheet" type="text/css" href="http://localhost/theFitnessBox/css/blogs.css" />';
				echo "<br>";
				if($_GET['orderID'])
				{
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
					if($r->num_rows!=0)
					{
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
					}
					else
					{	
						echo "<span style='color:#ff0000'>Now Such Entry Exists!!</span>";
						exit;
					}
				}
				elseif($_GET['blogDate'] && $_GET['blogTopic'])
				{
					include "mainDBConnect.php";
					//echo $_GET['blogTopic'];
					$topic=str_replace( '-',' ',$_GET['blogTopic']);
					//echo $topic;
					$sql="SELECT * FROM blogs WHERE authorEmail= '" . $_SESSION['email'] . "' AND dateOfPublishing='" . $_GET['blogDate'] . "' AND topic='" . $topic ."';";
					//echo $sql;
					$r=$conn->query($sql);
					echo "<center>";
						echo '<div id="blogsDisplay" name="blogsDisplay" class="blogsDisplay" style="display: block;">';
							echo "<div>";
								while($row=$r->fetch_assoc())
								{
									//print_r($row);
									echo "<h2>Topic : $row[topic]<br></h2>";
									echo "<sup>Author's Email : $row[authorEmail] || Date of Publish : $row[dateOfPublishing]</sup><br>";
									echo "<br><u>Blog:</u><br>";
									echo "$row[content]";
									echo "<hr color='#ffffff'>";
									echo "<hr color='#ffffff'>";
							}
							echo "</div>";
						echo "</center>";
					echo "</div>";
					//print_r($r);
					
				}
				
				
				echo "<br><br>";
				echo "<input type='button' class='customButton' value='<< Back to home' onclick=\"location.href = 'http://localhost/theFitnessBox/php/loggedIn.php'\">";
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

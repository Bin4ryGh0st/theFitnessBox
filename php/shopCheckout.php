<html>	
	<head>
		<?php
			session_start();
			if(!(($_SERVER["REQUEST_METHOD"] == "POST") && $_SESSION['email'] && $_SESSION['refresh']))
			{
				echo "<h1>Permission Denied!!</h1>";
				session_destroy();
				exit;
			}
			else
			{
				$_SESSION['refresh']=0;
			}
		?>
		<link rel="stylesheet" type="text/css" href="http://localhost/theFitnessBox/css/main.css" />
		<link rel="stylesheet" type="text/css" href="http://localhost/theFitnessBox/css/products.css" />
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
		<?php
			include "mainDBConnect.php";
			$cart = preg_split ("/\-/", $_POST['cartValues']);
			//print_r($cart);
			$size = sizeof($cart) - 1;
			$sum=0;
			$date=date("Y-m-d");
			$time=date("H:i:s");
			$email = $_SESSION['email'];
			$orderID = hash('md5', $time . $date . $email . $_POST['cartValues']);
			$sql='SELECT * FROM products WHERE productID IN (';
			echo "<br>";
			echo "<span class='cartHeading'><h2>Order ID : #$orderID</h2></span>";
			for($i=0;$i<$size;$i++)
			{	
				//echo 'productID = ' . $cart[$i] . " ";
				$sql .= ($cart[$i] . ",");	
			}
			$sql .= ($cart[$size] . ");");
			//echo $sql;
			$r = $conn->query($sql);
			$totalPrice = 0;
			$values ="INSERT INTO purchaseDetails VALUES ";
			echo "<span class='bill'>";
				echo "<span style='position:absolute;' > Product Id </span>" ;
				echo "<span class ='billPName' >Product</span>" ;
				echo "<span class ='billPPrice' > Cost</span>" ;
				echo "<br><br>";
			echo "</span>";
			$len=$r->num_rows;
			$tlen =0;
			while($row = $r->fetch_assoc())
			{
				$tlen+=1;
				$values .= ("('" . $orderID . "'," . $row['productID']  . ")");
				if($len!=$tlen)
				{
					$values .= ",";
				}
				else
				{
					$values .= ";";
				}
				echo "<span class='bill'>";
					echo "<span class ='billPID' >" .$row['productID'] . "</span>" ;
					echo "<span class ='billPName' >" .$row['productName'] . "</span>" ;
					echo "<span class ='billPPrice' >" .$row['price'] . " INR.</span>" ;
					echo "<br>";
				echo "</span>";
				$totalPrice+=$row['price'];
			}
			$sql = "INSERT INTO purchaseHistory VALUES ('$orderID','$email','$date',$len,$totalPrice);";
			//echo $sql;
			//echo "<br>" . $values;
			$conn->query($sql);
			echo $conn->connect_error;
			$conn->query($values);
			echo "<br>" . $conn->connect_error;
		?>
		<span style="color:#ffd700">
			-----------------------------------------------------------------------------------------------------------------------------------
		</span>
		<br>
		<span class ="bill billPName">
			Total :
		</span>
		<span class ="bill billPPrice">
			<?php
				echo $totalPrice . " INR.";
			?>
		</span>
		<br><br>
		<span style="color:#ffd700">Order Placed Successfully</span>
		<input type="button" class="customButton" style="position:absolute; left:28%;" value="Back to home" onclick="location.href = 'http://localhost/theFitnessBox/php/loggedIn.php'">
	</body> 
</html>

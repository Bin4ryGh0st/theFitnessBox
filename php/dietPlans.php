<html>
	<head>
		<?php
			session_start();
			if($_SESSION['email'])
			{
				include "mainDBConnect.php";
			}
			else
			{
				session_destroy();
				echo "<h1>Permission Denied!!</h1>"	;
				exit;
			}
		?>		
		<link rel="stylesheet" type="text/css" href="http://localhost/theFitnessBox/css/main.css" />
		<link rel="stylesheet" type="text/css" href="http://localhost/theFitnessBox/css/dietPlans.css" />
		<script src="http://localhost/theFitnessBox/js/dietPlans.js"></script>
	</head>
	
	<body bgcolor="#000000">
		<div class= "packHomeMenu">
			<a href="http://localhost/theFitnessBox/php/loggedIn.php"><img src="http://localhost/theFitnessBox/images/tfbLogo.png" width=240 height=40></a>
			<div class="homeMenu">
				<input class="customButton" type="button" id="My Profile" value="My Profile" onclick="location.href = 'http://localhost/theFitnessBox/php/loggedIn.php'">
				<input class="customButton" type="button" id="Blogs" value="Blogs" onclick="location.href = 'http://localhost/theFitnessBox/php/blogs.php'">
				<input class="customButton" type="button" id="Shop" value="Shop" onclick="location.href = 'http://localhost/theFitnessBox/php/products.php'">
				<input class="customButtonSelected" type="button" id="Diet Plans" value="Diet Plans" onclick="location.href = 'http://localhost/theFitnessBox/php/dietPlanss.php'">
				<input class="customButton" type="button" id="logOut" value="logout" onclick="location.href = 'http://localhost/theFitnessBox/php/logout.php'">
			</div>
		</div> 
		<center>
			<div id="newDietPlan" name="newDietPlan" class="newDietPlan" onclick="writeDietPlan()">
				<span id="guide" name="guide">&#9997; Post Your Diet Plan.</span>
			</div>
		</center>
		
		<div id="dietPlansDisplay" name="dietPlansDisplay" class="dietPlansDisplay" style="display: block;">
			<?php
				//echo $_SESSION['email'];
				include 'mainDBConnect.php';
				$sql="SELECT * FROM dietPlans order by dateOfPosting desc";
				$dietPlans = $conn->query($sql);
				//$noDietPlans = $dietPlans->num_rows;
				//print_r($dietPlans);
				echo "<center>";
					echo "<div>";
						while($row=$dietPlans->fetch_assoc())
						{
							//print_r($row);
							echo "<h2>For BMI upto : $row[BMIForPlan]<br></h2>";
							echo "<sup>Author's Email : $row[authorEmail] || Date of posting : $row[dateOfPosting]</sup><br>";
							echo "<br><u>Plan:</u><br>";
							echo "$row[plan]";
							echo "<hr color='#ffffff'>";
							echo "<hr color='#ffffff'>";
						}
					echo "</div>";
				echo "</center>";
			?>
		</div>
		
		<center>
			<div id="writeDietPlan" name="writeDietPlan" style="display: none;">
				<form id="addNewDietPlan" name="addNewDietPlan" method="post" action="http://localhost/theFitnessBox/php/insertDietPlan.php">
					<br>
					<input type="number" min="13" max="55" step="0.01" size="50" placeholder="BMI Suitable upto" id="newDietPlanTitle" name="newDietPlanTitle" class="dietPlanTitle" required>
					<br><br>
					<textarea rows="45" cols="100" placeholder="Content of the Diet Plan." id="newDietPlanContent" name="newDietPlanContent" class="dietPlanContent" required></textarea>
					<span id="charsLeft" name="charsLeft"></span>
					<br><br>
					<input type="submit" value="Post Diet Plan" class="customButton" id="submitDietPlan" name="submitDietPlan" style="opacity: 0.8;">
				</form>
			</div>
		</center>
		
	</body>
</html>

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
		<link rel="stylesheet" type="text/css" href="http://localhost/theFitnessBox/css/blogs.css" />
		<script src="http://localhost/theFitnessBox/js/blogs.js"></script>
	</head>
	
	<body bgcolor="#000000">
		<div class= "packHomeMenu">
			<a href="http://localhost/theFitnessBox/html/main.html"><img src="http://localhost/theFitnessBox/images/tfbLogo.png" width=240 height=40></a>
			<div class="homeMenu">
				<input class="customButton" type="button" id="My Profile" value="My Profile" onclick="location.href = 'http://localhost/theFitnessBox/php/loggedIn.php'">
				<input class="customButtonSelected" type="button" id="Blogs" value="Blogs" onclick="location.href = 'http://localhost/theFitnessBox/php/blogs.php'">
				<input class="customButton" type="button" id="Shop" value="Shop" onclick="">
				<input class="customButton" type="button" id="Diet Plans" value="Diet Plans" onclick="">
				<input class="customButton" type="button" id="logOut" value="logout" onclick="location.href = 'http://localhost/theFitnessBox/php/logout.php'">
			</div>
		</div> 
		<center>
			<div id="newBlog" name="newBlog" class="newBlog" onclick="writeBlog()">
				<span id="guide" name="guide">&#9997; Write Your blog.</span>
			</div>
		</center>
		
		<div id="blogsDisplay" name="blogsDisplay" class="blogsDisplay" style="display: block;">
			<?php
				//echo $_SESSION['email'];
				include 'mainDBConnect.php';
				$sql="SELECT * FROM blogs order by dateOfPublishing";
				$blogs = $conn->query($sql);
				//$noBlogs = $blogs->num_rows;
				//print_r($blogs);
				echo "<center>";
					echo "<div>";
						while($row=$blogs->fetch_assoc())
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
			?>
		</div>
		
		<center>
			<div id="writeBlog" name="writeBlog" style="display: none;">
				<form>
					<br>
					<input type="text" size="50" placeholder="Subject of the Blog." required>
					<br><br>
					<textarea rows="40" cols="100" placeholder="Content of the Blog." required></textarea>
					<span></span>
					<br><br>
					<input type="submit" value="Submit Blog" class="customButton" style="opacity: 0.8;">
				</form>
			</div>
		</center>
		
	</body>
</html>

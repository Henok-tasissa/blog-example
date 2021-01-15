<?php
session_start();
require("db.php");

?>
<!Doctype html>
<html>
	<head>
		<link href="./style.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		
		<div class="main-container">
			<nav>
				<a class="home-nav" href="index.php">HOME</a>
				<?php
					if(isset($_SESSION['userId'])){

						echo '<a class="sign-nav"  href="logout.php">Logout</a>';
						echo '<a style="margin-left:30px;" href="create.php">Create</a>';
					}else{
						echo '<a class="sign-nav" href="signup.php">    Sign Up</a>';
					}
				?>
			</nav>

			<content>

				<?php
					$sql = "SELECT * FROM blog";
					$query = mysqli_query($conn,$sql);

					
					while($blog = mysqli_fetch_assoc($query)){
						echo '<div class="blog-container"><h1>'.$blog['title'].'</h1><p>'.substr($blog['content'],0,250).'</p><a href="./blog.php?id='.$blog['id'].'">Read more</a></div>';
					}

				?>

				<!-- <div class="blog-container">
					<h1>Lorem ipsum dolor sit amet, consectetur adipisicing</h1>
					<p>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</p>
					<a href="./blog.php">Read more</a>
				</div> -->


			</content>
		</div>
	</body>
</html>
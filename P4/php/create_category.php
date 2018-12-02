<?php session_start();
include 'db_connect.php';?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
				<title>Forum</title>
			 <link href="styles.css" rel="stylesheet" type="text/css">
			 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
<body>

	<div class="content">
		<header>
			<ul class="nav" id="myTopnav">
				<li>
					<a class="item" href="forum.php">Home</a>
					<a class="item" href="create_topic.php">Create a topic</a>
					<a class="item" href="create_category.php">Create a category</a>
					<a class="item" href="profile.php">Profile</a>
					<a class="item" href="logout.php">Sign Out</a>
					<a href="javascript:void(0);" class="icon" onclick="myFunction()"><i class="fa fa-bars"></i></a>
				</li>
		 </ul>
		</header>
		 <main>

						 <div class="sect sectOne">
								 <h3>CREATE A CATEGORY</h3>
						 </div>

							 <div class="subSection">

												 <div class="ground">
													 <ul class="column2">
														 <?php

														 echo '<h2>Create a category</h2>';
														 if($_SESSION['logged_in'] == false | $_SESSION['user_level'] != 1 )
														 {
															 //the user is not an admin
															 ?> <p>Sorry, you do not have sufficient rights to access this page.<p> <?php
														 }
														 else
														 {
															 //the user has admin rights
															 if($_SERVER['REQUEST_METHOD'] != 'POST')
															 { ?>
																 <form method="post" action="">
																	 Category name: <input type="text" name="cat_name" /><br />
																	 Category description:<br /> <textarea name="cat_description" /></textarea><br /><br />
																	 <input type="submit" value="Add category" />
																 </form> <?php
															 }
															 else
															 {
																 $sql = "INSERT INTO
																					 categories(cat_name, cat_description)
																				 VALUES
																				 ('" . mysqli_real_escape_string($connection, $_POST['cat_name']) . "',
																				 '" . mysqli_real_escape_string($connection, $_POST['cat_description']) . "')";

																 $result = mysqli_query($connection, $sql);
																 if(!$result)
																 {
																	 ?> <p>Error</p> <?php //. mysqli_error($sql);
																 }
																 else
																 {
																	 ?> <p>New category succesfully added.</p> <?php
																 }
															 }
														 }
														 include 'footer.php';
														 ?>
													 </ul>
												 </div>

								 </div>

						 <div class="sect sectTwo">

						 </div>

							 <div class="subSection">
									 <h3 style="color: black; padding-top: 70px; padding-left: 105; padding-bottom: 50px;"><strong>TheNetworking Gurus&trade;</strong></h3>

											 <div class="olla"></div>

							 </div>


		 </main>
		 <footer>
				 <p>Copyright&#169; TheNetworking Gurus</p>
		 </footer>
	</div>

	<script>
	function myFunction() {
			var x = document.getElementById("myTopnav");
			if (x.className === "nav") {
					x.className += " responsive";
			} else {
					x.className = "nav";
			}
	}
	</script>
</body>
</html>

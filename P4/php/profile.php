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
								 <h3>PROFILE</h3>
						 </div>

							 <div class="subSection">

												 <div class="ground">
													 <ul class="column2">
                             <?php
                                if(isset($_SESSION['logged_in'])) {
                                    echo 'Hello, ' . $_SESSION['user_name'] . ' ';
                                }
                               ?>
													 </ul>
                           <div class="child_div_1">
                             <ul class="column2">
                               <img src="../img/avatar.png">
                             </ul>
                           </div>
                           <div class="child_div_2">
                             <ul class="column2">
                               <h2>Upload Your Works Here</h2>
                               <button><img src="../img/placehold.png"></button>
                             </ul>
                           </div>
												 </div>

								 </div>

						 <div class="sect sectTwo"></div>

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

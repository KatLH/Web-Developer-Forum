<?php
session_start();
include 'db_connect.php';
?>
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
		 <?php //include 'header.php'; ?>
		</header>
		 <main>

						 <div class="sect sectOne">
								 <h3>CURRENT TOPICS</h3>
						 </div>

							 <div class="subSection">

												 <div class="ground">
													 <ul class="column2">

                             <?php

                             $sql = "SELECT
                                         cat_id,
                                         cat_name,
                                         cat_description
                                     FROM
                                         categories
                                     WHERE
                                         cat_id = " . mysqli_real_escape_string($connection, $_GET['id']);

                             $result = mysqli_query($connection, $sql);

                             if(!$result)
                             {
                                 ?> <p>The category could not be displayed, please try again later.</p> <?php
                             }
                             else
                             {
                                 if(mysqli_num_rows($result) == 0)
                                 {
                                     ?> <p>This category does not exist</p> <?php
                                 }
                                 else
                                 {
                                     while($row = mysqli_fetch_assoc($result))
                                     {
                                         echo '<h2>Topics in ' . $row['cat_name'] . '</h2>';
                                     }

                                     $sql = "SELECT
                                                 topic_id,
                                                 topic_subject,
                                                 topic_date,
                                                 topic_cat
                                             FROM
                                                 topics
                                             WHERE
                                                 topic_cat = " . mysqli_real_escape_string($connection, $_GET['id']);

                                     $result = mysqli_query($connection, $sql);

                                     if(!$result)
                                     {
                                         ?> <p>The topics could not be displayed, please try again later.</p> <?php
                                     }
                                     else
                                     {
                                         if(mysqli_num_rows($result) == 0)
                                         {
                                             ?> <p>There are no topics in this category yet.</p> <?php
                                         }
                                         else
                                         { ?>
                                             <!--Topic header information-->
                                             <div>
                                                 Topic
                                                 Created at
                                             </div>
                                             <?php while($row = mysqli_fetch_assoc($result))
                                             { ?>
                                                 <div>
                                                     <?php echo '<h3><a href="topic.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a><h3>';

                                                     echo date('d-m-Y', strtotime($row['topic_date'])); ?>

                                                 </div> <?php
                                             }
                                         }
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

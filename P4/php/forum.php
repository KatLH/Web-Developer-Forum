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
		 </header>
			<main>

			<div class="sect sectOne">
					<h3>WELCOME<br>TO<br>&lt;CODE/bug&gt;</h3>
			</div>

				<div class="subSection">
                        <?php
                           if(isset($_SESSION['logged_in'])) {
                               echo 'Hello, ' . $_SESSION['user_name'] . ' ';
                           }
                          ?>

									<div class="ground">
										<ul class="column2">


										<?php
										$sql = "SELECT
													categories.cat_id,
													categories.cat_name,
													categories.cat_description,
													COUNT(topics.topic_id) AS topics
													FROM
														categories
													LEFT JOIN
														topics
													ON
														topics.topic_id = categories.cat_id
													GROUP BY
														categories.cat_name, categories.cat_description, categories.cat_id";
										$result = mysqli_query($connection, $sql);
										if(!$result)
										{
											echo 'The categories could not be displayed, please try again later.';
										}
										else
										{
											if(mysqli_num_rows($result) == 0)
											{
												echo 'No categories defined yet.';
											}
											else
											{ ?>
												<!--Section headers-->


											<?php while($row = mysqli_fetch_assoc($result)) { ?>


                                                    <div class="web"><h3><a href="category.php?id='<?php echo $row['cat_id']; ?>'"> <?php echo $row['cat_name']; ?></a></h3></div>
                                                    <div class="web_info">
	                                                <?php echo $row['cat_description']; ?>
                                                    </div> <?php

													$topicsql = "SELECT
																	topic_id,
																	topic_subject,
																	topic_date,
																	topic_cat
																FROM
																	topics
																WHERE
																	topic_cat = " . $row['cat_id'] . "
																ORDER BY
																	topic_date
																DESC
																	LIMIT 1";

													$topicsresult = mysqli_query($connection, $topicsql);

													if(!$topicsresult)
													{
														echo 'Last topic could not be displayed.';
													}
													else
													{
														if(mysqli_num_rows($topicsresult) == 0)
														{
                                                            ?> <div class="web_info"> <?php
															echo ' no topics';
                                                            ?> </div> <?php
														}
														else
														{
                                                            ?> <div class="web_info"> <?php                                      
															while($topicrow = mysqli_fetch_assoc($topicsresult))
															echo '<a href="topic.php?id=' . $topicrow['topic_id'] . '">' . $topicrow['topic_subject'] . '</a> at ' . date('d-m-Y', strtotime($topicrow['topic_date']));
                                                            ?> </div> <?php
														}
													}
												}
											}
										}
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

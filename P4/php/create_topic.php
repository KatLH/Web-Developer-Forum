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
									<h3>CREATE A TOPIC</h3>
							</div>

								<div class="subSection">

													<div class="ground">
														<ul class="column2">

                              <?php

                              ?> <h2>Create a topic</h2> <?php

                              if($_SESSION['logged_in'] == false)
                              {
                                  //the user is not signed in
                                  //change to HOMEPAGE
                                  ?> <span>Sorry, you have to be <a href="login.php">signed in</a> to create a topic.</span> <?php
                              }
                              else
                              {
                                  //the user is signed in
                                  if($_SERVER['REQUEST_METHOD'] != 'POST')
                                  {
                                      //the form hasn't been posted yet, display it
                                      //retrieve the categories from the database
                                      $sql = "SELECT
                                                  cat_id,
                                                  cat_name,
                                                  cat_description
                                              FROM
                                                  categories";

                                      $result = mysqli_query($connection, $sql);

                                      if(!$result)
                                      {
                                          //the query failed, uh-oh :-(
                                          ?> <p>Error while selecting from database. Please try again later.</p> <?php
                                      }
                                      else
                                      {
                                          if(mysqli_num_rows($result) == 0)
                                          {
                                              if($_SESSION['user_level'] == 1)
                                              {
                                                  ?> <p>You have not created categories yet.</p> <?php
                                              }
                                              else
                                              {
                                                  ?> <p>Before you can post a topic, you must wait for an admin to create some categories.</p> <?php
                                              }
                                          }
                                          else
                                          {
                                              ?> <form method="post" action="">
                                                      Subject:
                                                      <input type="text" name="topic_subject">

                                                      Category:
                                                      <select name="topic_cat"> <?php
                                                          while($row = mysqli_fetch_assoc($result))
                                                          { ?>
                                                              <option value="<?php echo $row['cat_id']?>">
                                                                  <?php echo $row['cat_name']; ?>
                                                              </option>
                                                          <?php } ?>
                                                      </select>

                                                      Message:
                                                      <textarea name="post_content"></textarea>
                                                      <input type="submit" value="Create topic" />
                                                  </form> <?php
                                          }
                                      }
                                  }
                                  else
                                  {
                                      $query  = "BEGIN WORK;";
                                      $result = mysqli_query($connection, $query);

                                      if(!$result)
                                      {
                                          ?> <p>An error occured while creating your topic. Please try again later.</p> <?php
                                      }
                                      else
                                      {
                                          $sql = "INSERT INTO
                                                      topics(topic_subject,
                                                             topic_date,
                                                             topic_cat,
                                                             topic_by)
                                                 VALUES('" . mysqli_real_escape_string($connection, $_POST['topic_subject']) . "',
                                                             NOW(),
                                                             '" . mysqli_real_escape_string($connection, $_POST['topic_cat']) . "',
                                                             '" . $_SESSION['user_id'] . "'
                                                             )";

                                          $result = mysqli_query($connection, $sql);
                                          if(!$result)
                                          {
                                              ?> <p>An error occured while inserting your data. Please try again later.</p> <?php
                                              $sql = "ROLLBACK;";
                                              $result = mysqli_query($connection, $sql);
                                          }
                                          else
                                          {
                                              $topicid = mysqli_insert_id($connection);

                                              $sql = "INSERT INTO
                                                          posts (post_content,
                                                                post_date,
                                                                post_topic,
                                                                post_by)
                                                      VALUES
                                                          ('" . mysqli_real_escape_string($connection, $_POST['post_content']) . "',
                                                                NOW(),
                                                                " . $topicid . ",
                                                                " . $_SESSION['user_id'] . "
                                                          )";
                                              $result = mysqli_query($connection, $sql);

                                              if(!$result)
                                              {
                                                  ?> <p>An error occured while inserting your post. Please try again later.</p> <?php
                                                  $sql = "ROLLBACK;";
                                                  $result = mysqli_query($connection, $sql);
                                              }
                                              else
                                              {
                                                  $sql = "COMMIT;";
                                                  $result = mysqli_query($connection, $sql);

                                                  ?> <span>You have successfully created <a href="topic.php?id=<?php echo $topicid; ?>">a new topic</a>.<span> <?php
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

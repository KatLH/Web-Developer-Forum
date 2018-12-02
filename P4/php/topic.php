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
<?php
  $topic_id = $_GET['id'];
  $sql = "SELECT
        			topic_id,
        			topic_subject
		      FROM
			        topics
		      WHERE
			        topics.topic_id = '".$topic_id."'";

  $result = mysqli_query($connection, $sql);

  if(!$result)
  {
  	?> <p>The topic could not be displayed, please try again later.</p> <?php
  }
  else
  {
  	if(mysqli_num_rows($result) == 0)
  	{
  		?> <p>This topic does not exist.</p> <?php
  	}
  	else
  	{
  		while($row = mysqli_fetch_assoc($result))
  		{
  			//display post data
            ?> <div> <?php
                echo $row['topic_subject'];
            ?> </div> <?php
  			//fetch the posts from the database
        $id = mysqli_real_escape_string($connection, $_GET['id']);

  			$posts_sql = "SELECT
  						posts.post_topic,
  						posts.post_content,
  						posts.post_date,
  						posts.post_by,
  						users.user_id,
  						users.username
  					FROM
  						posts
  					LEFT JOIN
  						users
  					ON
  						posts.post_by = users.user_id
  					WHERE
  						posts.post_topic = '".$id."'";

  			$posts_result = mysqli_query($connection, $posts_sql);

  			if(!$posts_result)
  			{
  	            ?> <p>The posts could not be displayed, please try again later.</p> <?php
  			}
  			else
  			{

  				while($posts_row = mysqli_fetch_assoc($posts_result))
  				{
                ?> <div> <?php
  					    echo $posts_row['username']; ?> <br> <?php
                        echo date('d-m-Y H:i', strtotime($posts_row['post_date'])); ?> <br> <?php
                        echo htmlentities(stripslashes($posts_row['post_content'])); ?> <br> <?php
                ?> </div> <?php
  				}
  			}

  			if(!isset($_SESSION['logged_in']))
  			{                                      //change to HOMEPAGE file
                ?> <span>You must be <a href="login.php">signed in</a> to reply. You can also <a href="register.php">sign up</a> for an account.</span> <?php
  			}
  			else
  			{
                echo '<form id="reply_form" method="post" action="reply.php?id=' . $row['topic_id'] . '">'; ?>
    				<textarea name="reply-content"></textarea><br /><br />
    				<input type="submit" value="Submit reply" />
    			</form> <?php
  			}
  		}
  	}
} ?>

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

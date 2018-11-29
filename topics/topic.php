<?php
  include '../database/db_connect.php';
  include '../include/header.php';

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
            ?> <div> <?php
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
                ?> <div> <?php
  				}
  			}

  			if(!isset($_SESSION['logged_in']))
  			{
                ?> <span>You must be <a href="../login/login.php">signed in</a> to reply. You can also <a href="../register/register.php">sign up</a> for an account.</span> <?php
  			}
  			else
  			{
  				?> <h2>Reply:</h2><br> <?php
                echo '<form method="post" action="../topics/reply.php?id=' . $row['topic_id'] . '">'; ?>
    				<textarea name="reply-content"></textarea><br /><br />
    				<input type="submit" value="Submit reply" />
    			</form> <?php
  			}
  		}
  	}
  }

  include '../include/footer.php';
?>

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
  	echo 'The topic could not be displayed, please try again later.';
  }
  else
  {
  	if(mysqli_num_rows($result) == 0)
  	{
  		echo 'This topic doesn&prime;t exist.';
  	}
  	else
  	{
  		while($row = mysqli_fetch_assoc($result))
  		{
  			//display post data
  			echo '<table border="1">
  					<tr>
  						<th colspan="2">' . $row['topic_subject'] . '</th>
  					</tr>';

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
  				echo '<tr>
                  <td>The posts could not be displayed, please try again later.</td>
                </tr>
              </table>';
  			}
  			else
  			{

  				while($posts_row = mysqli_fetch_assoc($posts_result))
  				{
  					echo '<tr>
  							    <td>' . $posts_row['username'] . '<br/>' . date('d-m-Y H:i', strtotime($posts_row['post_date'])) . '</td>
  							    <td>' . htmlentities(stripslashes($posts_row['post_content'])) . '</td>
  						    </tr>';
  				}
  			}

  			if(!isset($_SESSION['logged_in']))
  			{
  				echo '<tr>
                  <td colspan=2>You must be <a href="../login/login.php">signed in</a> to reply. You can also <a href="../register/register.php">sign up</a> for an account.';
  			}
  			else
  			{

  				echo '<tr>
                  <td colspan="2"><h2>Reply:</h2><br />
                    <form method="post" action="../topics/reply.php?id=' . $row['topic_id'] . '">
    						      <textarea name="reply-content"></textarea><br /><br />
    						      <input type="submit" value="Submit reply" />
    					      </form>
                  </td>
                </tr>';
  			}

  			echo '</table>';
  		}
  	}
  }

  include '../include/footer.php';
?>

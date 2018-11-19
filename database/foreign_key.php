<?php
  include 'db_connect.php';

  //link the topics to the categories
  $sql0 = "ALTER TABLE topics ADD FOREIGN KEY(topic_cat) REFERENCES categories(cat_id) ON DELETE CASCADE ON UPDATE CASCADE";

  mysqli_query($connection, $sql0) or die('Could not create table');


  //link the topics to the user who creates one
  $sql1 = "ALTER TABLE topics ADD FOREIGN KEY(topic_by) REFERENCES users(user_id) ON DELETE RESTRICT ON UPDATE CASCADE";

  mysqli_query($connection, $sql1) or die('Could not create table');


  //Link the posts to the topics
  $sql2 = "ALTER TABLE posts ADD FOREIGN KEY(post_topic) REFERENCES topics(topic_id) ON DELETE CASCADE ON UPDATE CASCADE;";

  mysqli_query($connection, $sql2) or die('Could not create table');



  //link each post to the user who made it
  $sql3 = "ALTER TABLE posts ADD FOREIGN KEY(post_by) REFERENCES users(user_id) ON DELETE RESTRICT ON UPDATE CASCADE;";

  mysqli_query($connection, $sql3) or die('Could not create table');

  

  mysqli_close($connection);
?>

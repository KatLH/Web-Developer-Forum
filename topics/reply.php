<?php
  include '../database/db_connect.php';
  include '../include/header.php';

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    ?> <p>This file cannot be called directly.</p> <?php
}
else
{
    if(!$_SESSION['logged_in'])
    {
        ?> <p>You must be signed in to post a reply.</p> <?php
    }
    else
    {
        $sql = "INSERT INTO
                    posts(post_content,
                          post_date,
                          post_topic,
                          post_by)
                VALUES ('" . $_POST['reply-content'] . "',
                        NOW(),
                        " . mysqli_real_escape_string($connection, $_GET['id']) . ",
                        " . $_SESSION['user_id'] . ")";

        $result = mysqli_query($connection, $sql);

        if(!$result)
        {
            ?> <p>Your reply has not been saved, please try again later.</p> <?php
        }
        else
        {
            echo 'Your reply has been saved, check out <a href="topic.php?id=' . htmlentities($_GET['id']) . '">the topic</a>.';
        }
    }
}

include '../include/footer.php';
?>

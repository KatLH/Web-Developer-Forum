<?php
include '../database/db_connect.php';
include '../include/header.php';

?> <h2>Create a topic</h2> <?php

if($_SESSION['logged_in'] == false)
{
    //the user is not signed in
    ?> <span>Sorry, you have to be <a href="../login/login.php">signed in</a> to create a topic.</span> <?php
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

                    ?> <span>You have successfully created <a href="../topics/topic.php?id=<?php echo $topicid; ?>">a new topic</a>.<span> <?php
                }
            }
        }
    }
}

include '../include/footer.php';
?>

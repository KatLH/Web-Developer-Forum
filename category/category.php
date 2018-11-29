<?php
include '../database/db_connect.php';
include '../include/header.php';

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
                        <?php echo '<h3><a href="../topics/topic.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a><h3>';

                        echo date('d-m-Y', strtotime($row['topic_date'])); ?>

                    </div> <?php
                }
            }
        }
    }
}

include '../include/footer.php';
?>

<?php
include '../database/db_connect.php';
include '../include/header.php';

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
		<div>
			Category
			Last topic
		</div>

	<?php while($row = mysqli_fetch_assoc($result)) {
			echo '<h3><a href="../category/category.php?id=' . $row['cat_id'] . '">' . $row['cat_name'] . '</a></h3>' . $row['cat_description'];

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
					echo 'no topics';
				}
				else
				{
					while($topicrow = mysqli_fetch_assoc($topicsresult))

					echo '<a href="../topics/topic.php?id=' . $topicrow['topic_id'] . '">' . $topicrow['topic_subject'] . '</a> at ' . date('d-m-Y', strtotime($topicrow['topic_date']));
				}
			}
		}
	}
}

include '../include/footer.php';
?>

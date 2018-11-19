<?php
include '../database/db_connect.php';
include '../include/header.php';

echo '<h2>Create a category</h2>';
if($_SESSION['logged_in'] == false | $_SESSION['user_level'] != 1 )
{
	//the user is not an admin
	echo 'Sorry, you do not have sufficient rights to access this page.';
}
else
{
	//the user has admin rights
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		echo '<form method="post" action="">
						Category name: <input type="text" name="cat_name" /><br />
						Category description:<br /> <textarea name="cat_description" /></textarea><br /><br />
						<input type="submit" value="Add category" />
		 			</form>';
	}
	else
	{
		$sql = "INSERT INTO
							categories(cat_name, cat_description)
		   			VALUES
						('" . mysqli_real_escape_string($connection, $_POST['cat_name']) . "',
				 		'" . mysqli_real_escape_string($connection, $_POST['cat_description']) . "')";

		$result = mysqli_query($connection, $sql);
		if(!$result)
		{
			echo 'Error' . mysqli_error($sql);
		}
		else
		{
			echo 'New category succesfully added.';
		}
	}
}

include '../include/footer.php';
?>

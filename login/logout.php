<?php
include '../database/db_connect.php';
include '../include/header.php';

echo '<h2>Sign out</h2>';

if($_SESSION['signed_in'] == true)
{

	unset($_SESSION['logged_in']);
	unset($_SESSION['user_name']);
	unset($_SESSION['user_id']);

	echo 'Succesfully signed out.';
	header("location: ../login/login.php");
}
else
{

}

include '../include/footer.php';
?>

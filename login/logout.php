<?php
include '../database/db_connect.php';
include '../include/header.php';

?> <h2>Logout</h2> <?php

if($_SESSION['logged_in'] == true)
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

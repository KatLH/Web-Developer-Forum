<?php
session_start();
include 'db_connect.php';

if($_SESSION['logged_in'] == true)
{

	unset($_SESSION['logged_in']);
	unset($_SESSION['user_name']);
	unset($_SESSION['user_id']);

	header("Location: homepage.php");
}
else
{

}
?>

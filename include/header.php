<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forum</title>
</head>
<body>
  <h1>Online Community for Web Developers in College</h1>
  <nav>
    <a class="item" href="../forums/index.php">Home</a> -
    <a class="item" href="../topics/create_topic.php">Create a topic</a> -
    <a class="item" href="../category/create_category.php">Create a category</a>
  </nav>

    <?php
      if(isset($_SESSION['logged_in']))
      {
          echo 'Hello, ' . $_SESSION['user_name'] . ' | <a href="../login/logout.php">Sign out</a>';
      }
      else
      {
          echo '<a href="../login/login.php">Sign in</a> or <a href="../register/register.php">create an account</a>.';
      } ?>

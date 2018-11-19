<?php
  $username = "ka119724";
  $password = "Periwinkle357@";
  $dbname = "ka119724";

  $connection = mysqli_connect("localhost" , "$username" , "$password", "$dbname") or die(mysql_error());

  //if (!$connection){
		//echo "<br/> Could not connect. <br/>";
		//die(mysql_error());
  //}else{
	//echo 'Connected successfully';
  //}
?>

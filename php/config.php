<?php
  //Database configuration, change it the way you want! 
  $hostname = "localhost:3308";
  $username = "root";
  $password = "";
  $dbname = "debt_manager";

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }
?>

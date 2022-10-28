<?php
require "database.php";

// sql to create table
$sql = "CREATE TABLE products (
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(128) NOT NULL,
  description text NOT NULL,
  price double NOT NULL,
  photo varchar(30) NOT NULL,
  created datetime NOT NULL,
  modified timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  )";
  
  // use exec() because no results are returned
  if (mysqli_query($conn,$sql)) {
    echo "Table products created successfully";
  } else {
    echo "Error creating table: " . mysqli_error($conn);
  }
  
mysqli_close($conn);
?>
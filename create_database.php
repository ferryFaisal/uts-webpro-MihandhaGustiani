<?php
require 'database.php';

// Create database
$sql = "CREATE DATABASE webpro";
if (mysqli_query($conn, $sql)) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
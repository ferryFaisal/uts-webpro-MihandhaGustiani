<?php
require "database.php";

$id = $_GET['id'];

$sql = "delete from products where id = '$id'";

mysqli_query($conn, $sql);
header('location: read_data.php');
?>
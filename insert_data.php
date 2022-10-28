<?php
require 'database.php';

//encryption passsword
$name = $_POST['name'];
$desc = $_POST['desc'];
$price = $_POST['price'];
$img_name = $_FILES['photo']['name'];
$tmp_name = $_FILES['photo']['tmp_name'];
$error = $_FILES['photo']['error'];

//insert data
if (isset($_POST['submit'])) {
  if($error === 0) {
    $img_extension = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_extension_loc = strtolower($img_extension);
    $extension_allowed = array('jpg', 'jpeg', 'png', 'webp', 'jfif');

    if (in_array($img_extension_loc, $extension_allowed)) {
      $new_name_img = uniqid('img-', true) . '.' . $img_extension_loc;
      $img_path = 'image/' . $new_name_img;

      move_uploaded_file($tmp_name, $img_path);
      $sql = "INSERT INTO products VALUES ('', '$name', '$desc', '$price', '$new_name_img', current_timestamp, current_timestamp)";
      mysqli_query($conn, $sql);
      echo "New record created successfully";
    } else {
      $err = 'cannot upload this type of file';
    }
  } 
} 

mysqli_close($conn);
header('Location : read_data.php');
?>
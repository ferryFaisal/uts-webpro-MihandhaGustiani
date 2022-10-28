<style>
.error {color: #ff0000}  
</style>
<?php
require 'database.php';
$nameErr = $descErr = $priceErr = $uploadErr = "";
$name = $desc = $price = $upload = "";
$valid_name = $valid_desc = $valid_price = $valid_upload = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    $valid_name = true;
    }
  
  if (empty($_POST["desc"])) {
    $descErr = "Description is required";
  } else {
    $desc = test_input($_POST["desc"]);
    $valid_desc = true;
    }

  if (empty($_POST["price"])) {
    $priceErr = "Price is required";
  } else {
    $price = test_input($_POST["price"]);
    $valid_price = true;
  }

  if (empty($_FILES["photo"])) {
    $uploadErr = "Upload is required";
  } else {
    $upload = test_input($_POST['photo']);
    $valid_upload = true;
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$id = $_GET['id'];
$sql = "select * from products where id = '$id'";

$query = mysqli_query($conn, $sql);

while ($result = mysqli_fetch_assoc($query)) {
    $name = $result['name'];
    $desc = $result['description'];
    $price = $result['price'];
    $upload = $result['photo'];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Update</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="name">Nama Produk : </label><br>
        <input type="text" name="name" value="<?= $name ?>"><br>
        <span class="error">* <?php echo $nameErr;?></span><br><br>
        <label for="desc">Deskripsi Produk : </label><br>
        <textarea name="description" id="description" cols="20" rows="10" placeholder="Enter new description here.."><?= $desc ?></textarea></br>
        <span class="error">* <?php echo $descErr;?></span><br><br>
        <label for="price">Harga Produk : </label><br>
        <input type="number" name="price" value="<?= $price ?>"><br>
        <span class="error">* <?php echo $priceErr;?></span><br><br>
        <label for="photo">Foto Produk : </label><br>
        <?= "<img style='max-width: 200px;' src='image/$upload'><br>" ?>
        <input type="file" name="file" value=""><br><br>
        <span class="error">* <?php echo $uploadErr;?></span><br><br>
        <button type="submit" name="submit">Update Data</button>
    </form>

    <?php


    if (isset($_POST['submit'])) {

        $name1 = $_POST['name'];
        $desc1 = $_POST['description'];
        $price1 = $_POST['price'];
        $img_name = $_FILES['file']['name'];
        $tmp_name = $_FILES['file']['tmp_name'];
        $error = $_FILES['file']['error'];

        if ($error === 0) {
            $img_extension = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_extension_loc = strtolower($img_extension);
            $extension_allowed = array('jpg', 'jpeg', 'png', 'webp', 'jfif');

            if (in_array($img_extension_loc, $extension_allowed)) {
                //making a unique name for the image
                $new_name_img = uniqid('img-', true) . '.' . $img_extension_loc;
                $img_path = 'image/' . $new_name_img;
                //moving the img from tmp to the destination.
                move_uploaded_file($tmp_name, $img_path);
                $update = "update products set name = '$name1', description = '$desc1', price = '$price1', photo = '$new_name_img', modified = current_timestamp where id = '$id'";
                mysqli_query($conn, $update);
                header('Location: read_data.php');
            }
        }
    }


    ?>
</body>

</html>
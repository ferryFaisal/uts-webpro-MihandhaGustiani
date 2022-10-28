<!DOCTYPE HTML>
<html>
<head>
<style>
.error {color: #ff0000}  
</style>
</head>    
<body>
<?php
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
?>


<h2>Registration</h2>
<form action="" method="post" enctype="multipart/form-data">
Nama Produk    : <br>
<input type="text" name="name" value="<?php echo $name;?>">
<span class="error">* <?php echo $nameErr;?></span><br><br>
Deskripsi Produk    : <br>
<textarea rows="5" cols="50" name="desc" value=""></textarea>
<span class="error">* <?php echo $descErr;?></span><br><br>
Harga Produk    : <br>
<input type="number" name="price" value="<?php echo $price;?>">
<span class="error">* <?php echo $priceErr;?></span><br><br>
Foto Produk    : <br>
<input type="file" name="photo" value="Upload">
<span class="error">* <?php echo $uploadErr;?></span><br><br>
<input type="submit" name="submit" value="Submit"> 
</form>

<?php
if ($valid_name && $valid_desc && $valid_price && $valid_upload == true) {
    echo '<h3>Data has been inserted to the table.</h3>';
    include "insert_data.php";
    header('location: read_data.php'); 
}
?>
</body>
</html>
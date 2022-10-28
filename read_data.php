<?php
require "database.php";

$sql = "select * from products";

$query = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,
        tr,
        td,
        th {
            border: 1px solid black;
            padding: 10px;
            border-collapse: collapse;
        }

        tr:nth-child(even) {
            background: #e6e6e6;
        }

        td a {
            width: 40px;
            height: 10px;
            border-radius: 5px;
            padding: 5px;
            text-decoration: none;
        }

        td .edit {
            background: limegreen;
            color: white;
        }

        td .delete {
            background: red;
            color: white;
        }

        .add-user {
            background: blue;
            border-radius: 5px;
            width: 115px;
            height: 15px;
            padding: 5px;
        }

        .add-user:hover {
            background: #0000ff90;
        }

        .add-user a {
            text-decoration: none;
            color: white;
        }

        .picture {
            max-width: 200pt;
        }
    </style>
</head>

<body>
    <caption><h2>Products</h2></caption>
    <table>
        <tr>
            <th>Nama Produk</th>
            <th>Deskripsi Produk</th>
            <th>Harga Produk</th>
            <th>Foto Produk</th>
            <th>Date Created</th>
            <th>Date Modified</th>
            <th>Action</th>
        </tr>
        <?php
        while ($result = mysqli_fetch_assoc($query)) :
        ?>
            <tr>
                <td><?= $result["name"] ?></td>
                <td><?= $result["description"] ?></td>
                <td><?= $result["price"] ?></td>
                <td><img src="image/<?= $result["photo"] ?>" alt="" class="picture"></td>
                <td><?= $result["created"] ?></td>
                <td><?= $result["modified"] ?></td>
                <td>
                <a href='update_data.php?id=<?= $result['id']?>'>Edit</a> |
                <a onclick = "return confirm ('Delete?')" href='delete_data.php?id=<?= $result['id']?>'>Delete</a>
            </td>
            </tr>
        <?php
        endwhile;
        mysqli_close($conn);
        ?>
    </table><br><br>
    <div class="add-user">
        <a href="form_registration.php">Tambah Produk</a>
    </div>
</body>

</html>
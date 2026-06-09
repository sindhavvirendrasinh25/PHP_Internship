<?php

include 'config/db.php';
include 'classes/product.php';

$db = new Database();
$conn = $db->connect();

$product = new Product($conn);

if(isset($_POST['save']))
{
    $product->create(
        $_POST['name'],
        $_POST['sku'],
        $_POST['price'],
        $_POST['description']
    );

    header("Location:index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-box">

<h2>Add Product</h2>

<form method="POST">

<input type="text"
name="name"
placeholder="Product Name"
required>

<input type="text"
name="sku"
placeholder="SKU"
required>

<input type="number"
step="0.01"
name="price"
placeholder="Price"
required>

<textarea
name="description"
placeholder="Description"></textarea>

<button name="save">
    Save Product
</button>

</form>

</div>

</body>
</html>
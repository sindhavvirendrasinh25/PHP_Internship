<?php

include 'config/Database.php';
include 'classes/Product.php';

$db = new Database();
$conn = $db->connect();

$product = new Product($conn);

$id = $_GET['id'];

$data = $product->getSingle($id);

if(isset($_POST['update']))
{
    $product->update(
        $id,
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
    <title>Update Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-box">

<h2>Update Product</h2>

<form method="POST">

<input type="text"
name="name"
value="<?php echo $data['name']; ?>"
required>

<input type="text"
name="sku"
value="<?php echo $data['sku']; ?>"
required>

<input type="number"
step="0.01"
name="price"
value="<?php echo $data['price']; ?>"
required>

<textarea name="description"><?php echo $data['description']; ?></textarea>

<button name="update">
    Update Product
</button>

</form>

</div>

</body>
</html>
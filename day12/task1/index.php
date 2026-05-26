<?php
require_once "Product.php";
$products = [
new Product("Laptop", "Electronics", 70000, 5),
new Product("Keyboard", "Accessories", 1000, 0),
new Product("Mouse", "Accessories", 700, 5),
new Product("Office Chair", "Furniture", 3500, 3)
];
?>
<!DOCTYPE html>
<html>
<head>
<title>Product OOP Demo</title>
<style>
body { font-family: Arial, sans-serif; background: #f4f7fb; padding: 30px; }
.container { max-width: 950px; margin: auto; background: white; padding: 25px; border-radius: 12px; }
h1 { color: #f7925c; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; }
th { background: #aa86e1; color: white; padding: 12px; }
td { padding: 10px; border: 1px solid #f682e7; text-align: center; }
.yes { color: green; font-weight: bold; }
.no { color: red; font-weight: bold; }
</style>
</head>
<body>
<div class="container">
<h1>Product List</h1>
<table>
<tr>
<th>Name</th>
<th>Category</th>
<th>Price</th>
<th>Stock</th>
<th>Available?</th>
<th>10% Discount Price</th>
</tr>
<?php foreach ($products as $product): ?>
<tr>
<td><?= htmlspecialchars($product->getName()) ?></td>
<td><?= htmlspecialchars($product->getCategory()) ?></td>
<td>Rs. <?= number_format($product->getPrice(), 2) ?></td>
<td><?= $product->getStock() ?></td>
<td class="<?= $product->isAvailable() ? 'yes' : 'no' ?>">
<?= $product->isAvailable() ? 'In Stock' : 'Out of Stock' ?>
</td>
<td>Rs. <?= number_format($product->getDiscountedPrice(10), 2) ?></td>
</tr>
<?php endforeach; ?>
</table>
</div>
</body>
</html>

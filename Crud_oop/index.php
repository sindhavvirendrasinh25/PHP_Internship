<?php

include 'config/db.php';
include 'classes/product.php';

$db = new Database();
$conn = $db->connect();

$product = new Product($conn);

if(isset($_GET['delete']))
{
    $product->delete($_GET['delete']);
    header("Location:index.php");
    exit();
}

$result = $product->read();

include 'includes/header.php';
?>

<a href="create.php" class="btn">Add Product</a>

<table>

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>SKU</th>
    <th>Price</th>
    <th>Description</th>
    <th>Created At</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['sku']; ?></td>
    <td><?php echo $row['price']; ?></td>
    <td><?php echo $row['description']; ?></td>
    <td><?php echo $row['created_at']; ?></td>

    <td>
        <a href="update.php?id=<?php echo $row['id']; ?>">
            Edit
        </a>

        |

        <a href="index.php?delete=<?php echo $row['id']; ?>"
           onclick="return confirm('Delete Product?')">
           Delete
        </a>
    </td>
</tr>

<?php } ?>

</table>

</div>
</body>
</html>
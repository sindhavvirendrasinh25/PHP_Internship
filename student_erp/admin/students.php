<?php

session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin')
{
    header("Location: ../auth/login.php");
    exit();
}

include '../db.php';

$result = mysqli_query(
$conn,
"SELECT * FROM users
WHERE role='student'"
);

include '../includes/header.php';
include '../includes/navbar.php';

?>

<h2>Students List</h2>

<table border="1" cellpadding="10">

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Actions</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td>

<td>

<a href="edit.php?type=student&id=<?php echo $row['id']; ?>">
✏️ Edit
</a>

|

<a href="delete.php?type=student&id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete Student?')">
🗑️ Delete
</a>

</td>

</td>

</tr>

<?php } ?>

</table>

<?php include '../includes/footer.php'; ?>
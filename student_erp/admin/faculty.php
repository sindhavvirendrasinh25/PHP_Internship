<?php

session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin')
{
    header("Location: ../auth/login.php");
    exit();
}

include '../db.php';

$result = mysqli_query($conn, "SELECT * FROM users WHERE role='faculty'");

include '../includes/header.php';
include '../includes/navbar.php';

?>

<div class="container">

    <h2>Faculty List</h2>

    <table border="1" cellpadding="10" cellspacing="0">

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created At</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)) { ?>

        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo ucfirst($row['role']); ?></td>
            <td><?php echo $row['created_at']; ?></td>
        </tr>

        <?php } ?>
        <td>

<a href="edit.php?type=faculty&id=<?php echo $row['id']; ?>">
✏️ Edit
</a>

|

<a href="delete.php?type=faculty&id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete Faculty?')">
🗑️ Delete
</a>

</td>

    </table>


</div>

<?php include '../includes/footer.php'; ?>
<?php

session_start();
include '../db.php';

include '../includes/header.php';
include '../includes/navbar.php';

$result = mysqli_query($conn,"SELECT * FROM assignments");
?>

<h2>Assignments</h2>

<table border="1" cellpadding="10">

<tr>
<th>Title</th>
<th>Download</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>
<td><?php echo $row['title']; ?></td>

<td>
<a href="../uploads/assignments/<?php echo $row['file']; ?>">
Download
</a>
</td>

</tr>

<?php } ?>

</table>

<?php include '../includes/footer.php'; ?>
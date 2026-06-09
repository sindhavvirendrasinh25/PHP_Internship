<?php

session_start();
include '../db.php';

include '../includes/header.php';
include '../includes/navbar.php';

$result = mysqli_query($conn,"SELECT * FROM attendance");
?>

<h2>Attendance Records</h2>

<table border="1" cellpadding="10">

<tr>
<th>ID</th>
<th>Student ID</th>
<th>Date</th>
<th>Status</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['student_id']; ?></td>
<td><?php echo $row['attendance_date']; ?></td>
<td><?php echo $row['status']; ?></td>
</tr>

<?php } ?>

</table>

<?php include '../includes/footer.php'; ?>
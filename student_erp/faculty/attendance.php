<?php

session_start();
include '../db.php';

if(isset($_POST['save']))
{
    foreach($_POST['status'] as $student_id => $status)
    {
        $date = date("Y-m-d");

        mysqli_query($conn,
        "INSERT INTO attendance(student_id,attendance_date,status)
        VALUES('$student_id','$date','$status')");
    }

    echo "<script>alert('Attendance Saved Successfully');</script>";
}

$result = mysqli_query($conn,
"SELECT * FROM users WHERE role='student'");

include '../includes/header.php';
include '../includes/navbar.php';
?>

<h2>Attendance Sheet</h2>

<form method="POST">

<table border="1" cellpadding="10">

<tr>
<th>ID</th>
<th>Name</th>
<th>Status</th>
<th>Actions</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td>
<?php echo $row['id']; ?>
</td>

<td>
<?php echo $row['name']; ?>
</td>
<td>

<a href="../admin/edit.php?type=attendance&id=<?php echo $row['id']; ?>">
✏️ Edit
</a>

|

<a href="../admin/delete.php?type=attendance&id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete Attendance?')">
🗑️ Delete
</a>

</td>

<td>

<select name="status[<?php echo $row['id']; ?>]">

<option value="Present">
Present
</option>

<option value="Absent">
Absent
</option>

</select>

</td>

</tr>

<?php } ?>

</table>

<br>

<button type="submit" name="save">
Save Attendance
</button>

</form>

<?php include '../includes/footer.php'; ?>
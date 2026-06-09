<?php

session_start();
include '../db.php';

if(isset($_POST['save']))
{
$student_id=$_POST['student_id'];
$subject=$_POST['subject'];
$marks=$_POST['marks'];

mysqli_query($conn,
"INSERT INTO marks(student_id,subject,marks)
VALUES('$student_id','$subject','$marks')");
}

include '../includes/header.php';
include '../includes/navbar.php';
?>

<h2>Add Marks</h2>

<form method="POST">

<input type="number"
name="student_id"
placeholder="Student ID"
required>

<input type="text"
name="subject"
placeholder="Subject"
required>

<input type="number"
name="marks"
placeholder="Marks"
required>

<button name="save">
Save Marks
</button>
<th>Actions</th>
<td>

<a href="../admin/edit.php?type=marks&id=<?php echo $row['id']; ?>">
✏️ Edit
</a>

|

<a href="../admin/delete.php?type=marks&id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete Marks?')">
🗑️ Delete
</a>

</td>

</form>

<?php include '../includes/footer.php'; ?>
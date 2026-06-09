<?php

session_start();
include '../db.php';

if(isset($_POST['add']))
{
$course=$_POST['course_name'];

mysqli_query($conn,
"INSERT INTO courses(course_name)
VALUES('$course')");
}

$result=mysqli_query($conn,
"SELECT * FROM courses");

include '../includes/header.php';
include '../includes/navbar.php';
?>

<h2>Courses</h2>

<form method="POST">

<input type="text"
name="course_name"
placeholder="Course Name"
required>

<button name="add">
Add Course
</button>

</form>

<br>

<table border="1" cellpadding="10">

<tr>
<th>ID</th>
<th>Course Name</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td>
<?php echo $row['id']; ?>
</td>

<td>
<?php echo $row['course_name']; ?>
</td>
<td>

<a href="edit.php?type=course&id=<?php echo $row['id']; ?>">
✏️ Edit
</a>

|

<a href="delete.php?type=course&id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete Course?')">
🗑️ Delete
</a>

</td>

</tr>

<?php } ?>

</table>

<?php include '../includes/footer.php'; ?>
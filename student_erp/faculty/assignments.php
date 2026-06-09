<?php

session_start();
include '../db.php';

if(isset($_POST['upload']))
{
$title=$_POST['title'];

$file=$_FILES['file']['name'];

move_uploaded_file(
$_FILES['file']['tmp_name'],
"../uploads/assignments/".$file
);

mysqli_query($conn,
"INSERT INTO assignments(title,file)
VALUES('$title','$file')");
}

include '../includes/header.php';
include '../includes/navbar.php';
?>

<h2>Upload Assignment</h2>

<form method="POST"
enctype="multipart/form-data">

<input type="text"
name="title"
placeholder="Assignment Title"
required>

<input type="file"
name="file"
required>

<button name="upload">
Upload
</button>
<td>
    <th>Actions</th>

<a href="../admin/edit.php?type=assignment&id=<?php echo $row['id']; ?>">
✏️ Edit
</a>

|

<a href="../admin/delete.php?type=assignment&id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete Assignment?')">
🗑️ Delete
</a>

</td>

</form>

<?php include '../includes/footer.php'; ?>
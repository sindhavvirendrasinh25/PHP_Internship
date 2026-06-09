<?php

session_start();
include '../db.php';

if(isset($_POST['add']))
{
    $title = $_POST['title'];
    $description = $_POST['description'];

    mysqli_query($conn,
    "INSERT INTO notices(title,description)
     VALUES('$title','$description')");
}

$result = mysqli_query($conn,"SELECT * FROM notices");

include '../includes/header.php';
include '../includes/navbar.php';
?>

<h2>Notice Board</h2>

<form method="POST">

<input type="text" name="title" placeholder="Title" required>

<br><br>

<textarea name="description" required></textarea>

<br><br>

<button name="add">Add Notice</button>

</form>

<hr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<h3><?php echo $row['title']; ?></h3>

<p><?php echo $row['description']; ?></p>

<hr>

<?php } ?>

<?php include '../includes/footer.php'; ?>
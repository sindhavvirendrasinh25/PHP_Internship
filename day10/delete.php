<?php

include 'config.php';

$id = $_GET['id'];

// Fetch Student Data
$query = "SELECT * FROM student 
          WHERE student_id='$id'";

$result = mysqli_query($conn,$query);

$row = mysqli_fetch_assoc($result);

// Delete Image
if(file_exists($row['profile_photo']))
{
    unlink($row['profile_photo']);
}

// Delete Record
$delete = "DELETE FROM student 
           WHERE student_id='$id'";

mysqli_query($conn,$delete);

// Redirect
header("Location:index.php");

?>
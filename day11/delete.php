<?php

include 'config.php';

$id = $_GET['id'];

$query = "SELECT * FROM user WHERE id='$id'";

$result = mysqli_query($conn,$query);

$row = mysqli_fetch_assoc($result);


// DELETE PROFILE PHOTO

if(file_exists($row['profile_photo']))
{
    unlink($row['profile_photo']);
}


// DELETE RESUME PDF

if(file_exists($row['resume_pdf']))
{
    unlink($row['resume_pdf']);
}


// DELETE RECORD

$delete = "DELETE FROM user WHERE id='$id'";

mysqli_query($conn,$delete);

header("Location:index.php");

exit();

?>
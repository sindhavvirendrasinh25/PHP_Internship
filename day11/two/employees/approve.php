<?php

session_start();

include '../db.php';

if($_SESSION['role'] != "admin"){

    header("Location: ../dashboard.php");

    exit();
}

$id = $_GET['id'];

$sql = "UPDATE social_media
        SET status='approved'
        WHERE id='$id'";

mysqli_query($conn, $sql);

header("Location: view.php");

exit();

?>
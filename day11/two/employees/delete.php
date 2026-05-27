<?php

session_start();

include '../db.php';

if($_SESSION['role'] != "admin"){

    echo "<script>

    alert('User cannot access this page');

    window.location='../dashboard.php';

    </script>";

    exit();
}

$id = $_GET['id'];

$sql = "DELETE FROM social_media
        WHERE id='$id'";

mysqli_query($conn, $sql);

header("Location: view.php");

exit();

?>
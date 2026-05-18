<?php

include 'config.php';

$id = $_GET['id'];

$sql = "DELETE FROM student WHERE student_id = $id";

mysqli_query($conn, $sql);

header("Location: index.php");

exit();

?>
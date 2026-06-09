<?php

session_start();
include '../db.php';

include '../includes/header.php';
include '../includes/navbar.php';



$students = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users WHERE role='student'"));

$faculty = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users WHERE role='faculty'"));

$courses = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM courses"));

?>

<h2>Reports</h2>

<p>Total Students : <?php echo $students; ?></p>

<p>Total Faculty : <?php echo $faculty; ?></p>

<p>Total Courses : <?php echo $courses; ?></p>

<?php include '../includes/footer.php'; ?>
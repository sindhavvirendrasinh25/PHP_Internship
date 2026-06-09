<?php

session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin')
{
    header("Location: ../auth/login.php");
    exit();
}

include '../db.php';

$totalStudents = mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM users WHERE role='student'")
);

$totalFaculty = mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM users WHERE role='faculty'")
);

$totalCourses = mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM courses")
);

$totalAssignments = mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM assignments")
);

include '../includes/header.php';
include '../includes/navbar.php';


?>

<div class="dashboard">

    <h1>Admin Dashboard</h1>

    <h2>Welcome, <?php echo $_SESSION['name']; ?></h2>

    <div class="cards">

        <div class="card">
            <h3><?php echo $totalStudents; ?></h3>
            <p>Total Students</p>
        </div>

        <div class="card">
            <h3><?php echo $totalFaculty; ?></h3>
            <p>Total Faculty</p>
        </div>

        <div class="card">
            <h3><?php echo $totalCourses; ?></h3>
            <p>Total Courses</p>
        </div>

        <div class="card">
            <h3><?php echo $totalAssignments; ?></h3>
            <p>Total Assignments</p>
        </div>

    </div>

    <br>

   

</div>

<?php include '../includes/footer.php'; ?>
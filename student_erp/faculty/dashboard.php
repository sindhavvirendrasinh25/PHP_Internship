<?php

session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'faculty')
{
    header("Location: ../auth/login.php");
    exit();
}

include '../db.php';

$totalStudents = mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM users WHERE role='student'")
);

$totalAssignments = mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM assignments")
);

$totalAttendance = mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM attendance")
);

$totalMarks = mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM marks")
);

include '../includes/header.php';
include '../includes/navbar.php';

?>

<div class="dashboard">

    <h1>Faculty Dashboard</h1>

    <h2>Welcome, <?php echo $_SESSION['name']; ?></h2>

    <div class="cards">

        <div class="card">
            <h3><?php echo $totalStudents; ?></h3>
            <p>Total Students</p>
        </div>

        <div class="card">
            <h3><?php echo $totalAttendance; ?></h3>
            <p>Attendance Records</p>
        </div>

        <div class="card">
            <h3><?php echo $totalMarks; ?></h3>
            <p>Marks Records</p>
        </div>

        <div class="card">
            <h3><?php echo $totalAssignments; ?></h3>
            <p>Assignments</p>
        </div>

    </div>

    <br>

   

</div>

<?php include '../includes/footer.php'; ?>
<?php

session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'student')
{
    header("Location: ../auth/login.php");
    exit();
}

include '../db.php';

$totalAssignments = mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM assignments")
);

$totalNotices = mysqli_num_rows(
mysqli_query($conn,"SELECT * FROM notices")
);

include '../includes/header.php';
include '../includes/navbar.php';

?>

<div class="dashboard">

    <h1>Student Dashboard</h1>

    <h2>Welcome, <?php echo $_SESSION['name']; ?></h2>

    <div class="cards">

        <div class="card">
            <h3><?php echo $totalAssignments; ?></h3>
            <p>Assignments Available</p>
        </div>

        <div class="card">
            <h3><?php echo $totalNotices; ?></h3>
            <p>Notices</p>
        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>
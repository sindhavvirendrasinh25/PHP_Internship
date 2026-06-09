<div class="navbar">

    <h2>🎓 Student ERP</h2>

    <div class="menu">

        <button class="menu-btn">☰</button>

        <div class="dropdown">

            <?php if($_SESSION['role']=="admin"){ ?>

                <a href="../admin/students.php">👨‍🎓 Students</a>
                <a href="../admin/faculty.php">👨‍🏫 Faculty</a>
                <a href="../admin/add_faculty.php">➕ Add Faculty</a>
                <a href="../admin/courses.php">📚 Courses</a>
                <a href="../admin/notices.php">📢 Notices</a>
                <a href="../admin/reports.php">📊 Reports</a>

            <?php } ?>

            <?php if($_SESSION['role']=="faculty"){ ?>

                <a href="../faculty/attendance.php">📅 Attendance</a>
                <a href="../faculty/marks.php">📝 Marks</a>
                <a href="../faculty/assignments.php">📚 Assignments</a>

            <?php } ?>

            <?php if($_SESSION['role']=="student"){ ?>

                <a href="../student/attendance.php">📅 Attendance</a>
                <a href="../student/marks.php">📝 Marks</a>
                <a href="../student/assignments.php">📚 Assignments</a>
                <a href="../student/timetable.php">⏰ Timetable</a>

            <?php } ?>

            <a href="../auth/logout.php">🚪 Logout</a>

        </div>

    </div>

</div>

<?php
if(basename($_SERVER['PHP_SELF']) != 'dashboard.php')
{
?>
<div style="padding:15px;">
    <button onclick="history.back()" class="back-btn">
        Back
    </button>
</div>
<?php
}
?>
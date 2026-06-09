<?php
session_start();

if(isset($_SESSION['role']))
{
    if($_SESSION['role'] == 'admin')
    {
        header("Location: admin/dashboard.php");
        exit();
    }

    if($_SESSION['role'] == 'faculty')
    {
        header("Location: faculty/dashboard.php");
        exit();
    }

    if($_SESSION['role'] == 'student')
    {
        header("Location: student/dashboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student ERP</title>
</head>
<body>

<h1>Student ERP System</h1>

<a href="auth/login.php">Login</a>
<a href="auth/register.php">Register</a>

</body>
</html>
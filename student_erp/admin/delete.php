<?php

session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin')
{
    header("Location: ../auth/login.php");
    exit();
}

include '../db.php';

$type = $_GET['type'];
$id = $_GET['id'];

if($type == 'student')
{
    mysqli_query($conn,
    "DELETE FROM users
    WHERE id='$id'");

    header("Location: students.php");
}

elseif($type == 'faculty')
{
    mysqli_query($conn,
    "DELETE FROM users
    WHERE id='$id'");

    header("Location: faculty.php");
}

elseif($type == 'course')
{
    mysqli_query($conn,
    "DELETE FROM courses
    WHERE id='$id'");

    header("Location: courses.php");
}

elseif($type == 'attendance')
{
    mysqli_query($conn,
    "DELETE FROM attendance WHERE id='$id'");

    header("Location: ../faculty/attendance.php");
}

elseif($type == 'marks')
{
    mysqli_query($conn,
    "DELETE FROM marks WHERE id='$id'");

    header("Location: ../faculty/marks.php");
}

elseif($type == 'assignment')
{
    mysqli_query($conn,
    "DELETE FROM assignments WHERE id='$id'");

    header("Location: ../faculty/assignments.php");
}
?>
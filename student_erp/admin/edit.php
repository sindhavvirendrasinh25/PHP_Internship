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

/* STUDENT & FACULTY */

if($type == "student" || $type == "faculty")
{
    $result = mysqli_query($conn,
    "SELECT * FROM users WHERE id='$id'");

    $row = mysqli_fetch_assoc($result);

    if(isset($_POST['update']))
    {
        $name = $_POST['name'];
        $email = $_POST['email'];

        mysqli_query($conn,
        "UPDATE users
        SET
        name='$name',
        email='$email'
        WHERE id='$id'");

        if($type=="student")
        {
            header("Location: students.php");
        }
        else
        {
            header("Location: faculty.php");
        }
    }
}

/* COURSE */

if($type == "course")
{
    $result = mysqli_query($conn,
    "SELECT * FROM courses WHERE id='$id'");

    $row = mysqli_fetch_assoc($result);

    if(isset($_POST['update']))
    {
        $course_name = $_POST['course_name'];

        mysqli_query($conn,
        "UPDATE courses
        SET course_name='$course_name'
        WHERE id='$id'");

        header("Location: courses.php");
    }
}

/* ATTENDANCE */

if($type == "attendance")
{
    $result = mysqli_query($conn,
    "SELECT * FROM attendance WHERE id='$id'");

    $row = mysqli_fetch_assoc($result);

    if(isset($_POST['update']))
    {
        $status = $_POST['status'];

        mysqli_query($conn,
        "UPDATE attendance
        SET status='$status'
        WHERE id='$id'");

        header("Location: ../faculty/attendance.php");
    }
}

/* MARKS */

if($type == "marks")
{
    $result = mysqli_query($conn,
    "SELECT * FROM marks WHERE id='$id'");

    $row = mysqli_fetch_assoc($result);

    if(isset($_POST['update']))
    {
        $marks = $_POST['marks'];

        mysqli_query($conn,
        "UPDATE marks
        SET marks='$marks'
        WHERE id='$id'");

        header("Location: ../faculty/marks.php");
    }
}

/* ASSIGNMENTS */

if($type == "assignment")
{
    $result = mysqli_query($conn,
    "SELECT * FROM assignments WHERE id='$id'");

    $row = mysqli_fetch_assoc($result);

    if(isset($_POST['update']))
    {
        $title = $_POST['title'];

        mysqli_query($conn,
        "UPDATE assignments
        SET title='$title'
        WHERE id='$id'");

        header("Location: ../faculty/assignments.php");
    }
}

include '../includes/header.php';
include '../includes/navbar.php';

?>

<h2>Edit Record</h2>

<form method="POST">

<?php if($type=="student" || $type=="faculty"){ ?>

<input type="text"
name="name"
value="<?php echo $row['name']; ?>"
required>

<br><br>

<input type="email"
name="email"
value="<?php echo $row['email']; ?>"
required>

<?php } ?>

<?php if($type=="course"){ ?>

<input type="text"
name="course_name"
value="<?php echo $row['course_name']; ?>"
required>

<?php } ?>

<?php if($type=="attendance"){ ?>

<select name="status">

<option value="Present"
<?php if($row['status']=="Present") echo "selected"; ?>>
Present
</option>

<option value="Absent"
<?php if($row['status']=="Absent") echo "selected"; ?>>
Absent
</option>

</select>

<?php } ?>

<?php if($type=="marks"){ ?>

<input type="number"
name="marks"
value="<?php echo $row['marks']; ?>"
required>

<?php } ?>

<?php if($type=="assignment"){ ?>

<input type="text"
name="title"
value="<?php echo $row['title']; ?>"
required>

<?php } ?>

<br><br>

<button type="submit" name="update">
Update
</button>

</form>

<?php include '../includes/footer.php'; ?>
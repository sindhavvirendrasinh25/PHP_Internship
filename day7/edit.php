<?php

include 'config.php';

$id = $_GET['id'];

$fetch = "SELECT * FROM student WHERE student_id = $id";

$result = mysqli_query($conn, $fetch);

$row = mysqli_fetch_assoc($result);


if(isset($_POST['update'])){

    $name = $_POST['name'];
    $roll_no = $_POST['roll_no'];
    $age = $_POST['age'];
    $city = $_POST['city'];
    $std = $_POST['std'];

    $sql = "UPDATE student SET

            student_name = '$name',
            student_roll_no = '$roll_no',
            student_age = '$age',
            student_city = '$city',
            student_std = '$std'

            WHERE student_id = $id";

    mysqli_query($conn, $sql);

    header("Location: index.php");

    exit();
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Edit Student</title>

    <style>

        body{
            font-family: Arial;
            background: #f4f4f4;
            padding: 20px;
        }

        form{
            background: white;
            width: 400px;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
        }

        input{
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            box-sizing: border-box;
        }

        button{
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            background: green;
            color: white;
            border: none;
        }

    </style>

</head>
<body>

    <form method="POST">

        <input type="text"
               name="name"
               value="<?php echo $row['student_name']; ?>"
               required>

        <input type="number"
               name="roll_no"
               value="<?php echo $row['student_roll_no']; ?>"
               required>

        <input type="number"
               name="age"
               value="<?php echo $row['student_age']; ?>"
               required>

        <input type="text"
               name="city"
               value="<?php echo $row['student_city']; ?>"
               required>

        <input type="text"
               name="std"
               value="<?php echo $row['student_std']; ?>"
               required>

        <button type="submit" name="update">
            Update Student
        </button>

    </form>

</body>
</html>
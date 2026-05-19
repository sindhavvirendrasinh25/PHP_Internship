<?php

include 'config.php';


// INSERT DATA

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $roll_no = $_POST['roll_no'];
    $age = $_POST['age'];
    $city = $_POST['city'];
    $std = $_POST['std'];

    $sql = "INSERT INTO student(

            student_name,
            student_roll_no,
            student_age,
            student_city,
            student_std

            )

            VALUES(

            '$name',
            '$roll_no',
            '$age',
            '$city',
            '$std'

            )";

    mysqli_query($conn, $sql);

    header("Location: index.php");

    exit();
}


// FETCH DATA

$fetch = "SELECT * FROM student";

$result = mysqli_query($conn, $fetch);

?>

<!DOCTYPE html>
<html>
<head>

    <title>Student Management System</title>

    <style>

        body{
            font-family: Arial;
            background: #f4f4f6;
            padding: 20px;
        }

        h1{
            text-align: center;
        }

        .btn{
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
        }

        .back-btn{
            background: gray;
        }

        form{
            background: white;
            width: 400px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px gray;
        }

        input{
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            box-sizing: border-box;
        }

        table{
            width: 95%;
            margin: 30px auto;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }

        th{
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
            color: white;
            padding: 15px;
            font-size: 18px;
        }

        td{
            padding: 12px;
            text-align: center;
        }

        tr:nth-child(even){
            background: #f2f2f2;
        }

        tr:hover{
            background: #ffeaa7;
        }

        .edit-btn{
            background: #00b894;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
        }

        .delete-btn{
            background: #d63031;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
        }

        .top-buttons{
            margin-bottom: 20px;
        }

    </style>

</head>
<body>

    <h1>Student Management System</h1>

    <?php

    if(isset($_GET['add'])){

    ?>

    <form method="POST">

        <input type="text"
               name="name"
               placeholder="Enter Name"
               required>

        <input type="number"
               name="roll_no"
               placeholder="Enter Roll Number"
               required>

        <input type="number"
               name="age"
               placeholder="Enter Age"
               required>

        <input type="text"
               name="city"
               placeholder="Enter City"
               required>

        <input type="text"
               name="std"
               placeholder="Enter Standard"
               required>

        <button class="btn" type="submit" name="submit">
            Save Student
        </button>

        <br><br>

        <a href="index.php" class="btn back-btn">
            Back
        </a>

    </form>

    <?php

    } else {

    ?>

    <div class="top-buttons">

        <a href="index.php?add=1" class="btn">
            Add Student
        </a>

        <a href="search.php" class="btn">
            Search Student
        </a>

    </div>

    <table>

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Roll No</th>
            <th>Age</th>
            <th>City</th>
            <th>STD</th>
            <th>Action</th>
        </tr>

        <?php

        while($row = mysqli_fetch_assoc($result)){

        ?>

        <tr>

            <td><?php echo $row['student_id']; ?></td>

            <td><?php echo $row['student_name']; ?></td>

            <td><?php echo $row['student_roll_no']; ?></td>

            <td><?php echo $row['student_age']; ?></td>

            <td><?php echo $row['student_city']; ?></td>

            <td><?php echo $row['student_std']; ?></td>

            <td>

                <a class="edit-btn"
                   href="edit.php?id=<?php echo $row['student_id']; ?>">
                   Edit
                </a>

                <a class="delete-btn"
                   href="delete.php?id=<?php echo $row['student_id']; ?>">
                   Delete
                </a>

            </td>

        </tr>

        <?php
        }
        ?>

    </table>

    <?php
    }
    ?>

</body>
</html>
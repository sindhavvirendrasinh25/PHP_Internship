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

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
    }

    body{
        font-family:Arial, Helvetica, sans-serif;
        background:#ececec;
        padding:20px;
    }

    h1{
        text-align:center;
        font-size:55px;
        margin-bottom:40px;
        color:#111;
    }

    .top-buttons{
        margin-bottom:20px;
    }

    .btn{
        background:linear-gradient(45deg,#6a11cb,#2575fc);
        color:white;
        padding:12px 22px;
        border-radius:6px;
        text-decoration:none;
        display:inline-block;
        margin-right:10px;
        transition:0.3s;
    }

    .btn:hover{
        opacity:0.9;
    }

    .back-btn{
        background:gray;
    }

    form{
        width:420px;
        background:white;
        margin:30px auto;
        padding:30px;
        border-radius:15px;
        box-shadow:0 5px 20px rgba(0,0,0,0.2);
    }

    input{
        width:100%;
        padding:12px;
        margin-top:12px;
        border:1px solid #ccc;
        border-radius:6px;
        font-size:15px;
    }

    table{
        width:95%;
        margin:30px auto;
        border-collapse:collapse;
        background:white;
        border-radius:15px;
        overflow:hidden;
        box-shadow:0 5px 20px rgba(0,0,0,0.2);
    }

    th{
        background:linear-gradient(45deg,#ff416c,#ff4b2b);
        color:white;
        padding:18px;
        font-size:20px;
    }

    td{
        padding:16px;
        text-align:center;
        font-size:17px;
    }

    tr:nth-child(even){
        background:#f2f2f2;
    }

    tr:hover{
        background:#ffeaa7;
        transition:0.3s;
    }

    .edit-btn{
        background:#00b894;
        color:white;
        padding:8px 15px;
        border-radius:5px;
        text-decoration:none;
    }

    .delete-btn{
        background:#d63031;
        color:white;
        padding:8px 15px;
        border-radius:5px;
        text-decoration:none;
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
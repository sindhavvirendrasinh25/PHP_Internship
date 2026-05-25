<?php

include 'config.php';

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $age = $_POST['age'];
    $std = $_POST['std'];
    $city = $_POST['city'];
    $roll_no = $_POST['roll_no'];

    // IMAGE UPLOAD

    if($_FILES['profile_photo']['name'] != "")
    {
        $filename = $_FILES['profile_photo']['name'];

        $tempname = $_FILES['profile_photo']['tmp_name'];

        $targetpath = "uploads/" . $filename;

        move_uploaded_file($tempname, $targetpath);
    }
    else
    {
        $targetpath = "uploads/default-avatar.png";
    }

    // INSERT QUERY

    $sql = "INSERT INTO student(
                student_name,
                student_age,
                student_std,
                student_city,
                student_roll_no,
                profile_photo
            )
            VALUES(
                '$name',
                '$age',
                '$std',
                '$city',
                '$roll_no',
                '$targetpath'
            )";

    $result = mysqli_query($conn, $sql);

    if($result){
        header("Location:index.php");
    }else{
        echo "Data not inserted";
    }
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Add Student</title>

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

        .form-box{
            width:420px;
            margin:50px auto;
            background:white;
            padding:30px;
            border-radius:15px;
            box-shadow:0 5px 20px rgba(0,0,0,0.2);
        }

        h2{
            text-align:center;
            margin-bottom:25px;
            font-size:35px;
        }

        input{
            width:100%;
            padding:12px;
            margin-top:12px;
            border:1px solid #ccc;
            border-radius:6px;
            font-size:15px;
        }

        label{
            display:block;
            margin-top:18px;
            font-weight:bold;
        }

        button{
            width:100%;
            padding:12px;
            margin-top:20px;
            background:linear-gradient(45deg,#6a11cb,#2575fc);
            color:white;
            border:none;
            border-radius:6px;
            font-size:16px;
            cursor:pointer;
        }

        button:hover{
            opacity:0.9;
        }

    </style>

</head>

<body>

<div class="form-box">

    <h2>Add Student</h2>

    <form method="POST"
          enctype="multipart/form-data">

        <input type="text"
               name="name"
               placeholder="Enter Name"
               required>

        <input type="number"
               name="age"
               placeholder="Enter Age"
               required>

        <input type="text"
               name="std"
               placeholder="Enter STD"
               required>

        <input type="text"
               name="city"
               placeholder="Enter City"
               required>

        <input type="text"
               name="roll_no"
               placeholder="Enter Roll Number"
               required>

        <label>Upload Profile Photo</label>

        <input type="file"
               name="profile_photo">

        <button type="submit" name="submit">
            Submit
        </button>

    </form>

</div>

</body>
</html>
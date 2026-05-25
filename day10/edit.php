<?php

include 'config.php';

$id = $_GET['id'];

$query = "SELECT * FROM student 
          WHERE student_id='$id'";

$result = mysqli_query($conn,$query);

$row = mysqli_fetch_assoc($result);


// UPDATE DATA

if(isset($_POST['update']))
{
    $name = $_POST['name'];
    $age = $_POST['age'];
    $std = $_POST['std'];
    $city = $_POST['city'];
    $roll_no = $_POST['roll_no'];

    // NEW IMAGE

    if($_FILES['profile_photo']['name'] != "")
    {
        $filename = $_FILES['profile_photo']['name'];

        $tempname = $_FILES['profile_photo']['tmp_name'];

        $targetpath = "uploads/" . $filename;

        move_uploaded_file($tempname,$targetpath);

        // DELETE OLD IMAGE EXCEPT DEFAULT AVATAR

        if($row['profile_photo'] != "uploads/default-avatar.png")
        {
            if(file_exists($row['profile_photo']))
            {
                unlink($row['profile_photo']);
            }
        }
    }
    else
    {
        $targetpath = $row['profile_photo'];
    }

    // UPDATE QUERY

    $update = "UPDATE student
               SET student_name='$name',
               student_age='$age',
               student_std='$std',
               student_city='$city',
               student_roll_no='$roll_no',
               profile_photo='$targetpath'
               WHERE student_id='$id'";

    mysqli_query($conn,$update);

    header("Location:index.php");
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Edit Student</title>

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
            margin:40px auto;
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

        img{
            display:block;
            margin:20px auto;
            border-radius:10px;
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

<h2>Edit Student</h2>

<form method="POST"
      enctype="multipart/form-data">

    <input type="text"
           name="name"
           value="<?php echo $row['student_name']; ?>"
           required>

    <input type="number"
           name="age"
           value="<?php echo $row['student_age']; ?>"
           required>

    <input type="text"
           name="std"
           value="<?php echo $row['student_std']; ?>"
           required>

    <input type="text"
           name="city"
           value="<?php echo $row['student_city']; ?>"
           required>

    <input type="text"
           name="roll_no"
           value="<?php echo $row['student_roll_no']; ?>"
           required>

    <img src="<?php echo $row['profile_photo']; ?>"
         width="120">

    <input type="file"
           name="profile_photo">

    <button type="submit"
            name="update">
        Update Student
    </button>

</form>

</div>

</body>
</html>
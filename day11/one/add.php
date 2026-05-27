<?php

include 'config.php';

if(!isset($_SESSION['user']))
{
    header("Location: login.php");
    exit();
}

if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $age = $_POST['age'];
    $city = $_POST['city'];
    $branch = $_POST['branch'];

    $photo_name = $_FILES['profile_photo']['name'];
    $photo_tmp = $_FILES['profile_photo']['tmp_name'];

    $photo_ext = strtolower(pathinfo($photo_name, PATHINFO_EXTENSION));

    $allowed_photo = array("jpg","jpeg","png");

    if(!in_array($photo_ext,$allowed_photo))
    {
        die("Only JPG, JPEG and PNG allowed");
    }

    $photo_path = "uploads/" . $photo_name;

    move_uploaded_file($photo_tmp, $photo_path);

    $resume_name = $_FILES['resume_pdf']['name'];

    $resume_tmp = $_FILES['resume_pdf']['tmp_name'];

    $resume_ext = strtolower(pathinfo($resume_name, PATHINFO_EXTENSION));

    if($resume_ext != "pdf")
    {
        die("Only PDF allowed");
    }

    $resume_path = "uploads_resume/" . $resume_name;

    move_uploaded_file($resume_tmp, $resume_path);

    $sql = "INSERT INTO user(
            name,
            age,
            city,
            branch,
            profile_photo,
            resume_pdf
            )

            VALUES(
            '$name',
            '$age',
            '$city',
            '$branch',
            '$photo_path',
            '$resume_path'
            )";

    mysqli_query($conn,$sql);

    header("Location:index.php");

    exit();
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Add User</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:Arial;
            background:#ececec;
            padding:20px;
        }

        .form-box{
            width:450px;
            margin:40px auto;
            background:white;
            padding:30px;
            border-radius:15px;
            box-shadow:0 5px 20px rgba(0,0,0,0.2);
        }

        h2{
            text-align:center;
            margin-bottom:20px;
            font-size:35px;
        }

        input{
            width:100%;
            padding:12px;
            margin-top:12px;
            border:1px solid #ccc;
            border-radius:6px;
        }

        label{
            display:block;
            margin-top:15px;
            font-weight:bold;
        }

        button{
            width:100%;
            padding:12px;
            margin-top:18px;
            background:linear-gradient(45deg,#6a11cb,#2575fc);
            color:white;
            border:none;
            border-radius:6px;
            cursor:pointer;
            font-size:16px;
        }

        #preview{
            margin-top:15px;
            border-radius:10px;
            display:none;
            object-fit:cover;
        }

    </style>

</head>
<body>

<div class="form-box">

<h2>Add User</h2>

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
           name="city"
           placeholder="Enter City"
           required>

    <input type="text"
           name="branch"
           placeholder="Enter Branch"
           required>

    <label>Upload Profile Photo</label>

    <input type="file"
           name="profile_photo"
           accept=".jpg,.jpeg,.png"
           onchange="previewImage(event)"
           required>

    <img id="preview"
         width="120"
         height="120">

    <label>Upload Resume PDF</label>

    <input type="file"
           name="resume_pdf"
           accept=".pdf"
           required>

    <button type="submit"
            name="submit">
        Save User
    </button>

</form>

</div>

<script>

function previewImage(event)
{
    var image = document.getElementById("preview");

    image.src = URL.createObjectURL(event.target.files[0]);

    image.style.display = "block";
}

</script>

</body>
</html>
<?php

include 'config.php';

$id = $_GET['id'];

$query = "SELECT * FROM user WHERE id='$id'";

$result = mysqli_query($conn,$query);

$row = mysqli_fetch_assoc($result);


// UPDATE DATA

if(isset($_POST['update']))
{
    $name = $_POST['name'];
    $age = $_POST['age'];
    $city = $_POST['city'];
    $branch = $_POST['branch'];


    // PHOTO UPDATE

    if($_FILES['profile_photo']['name'] != "")
    {
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

        unlink($row['profile_photo']);
    }
    else
    {
        $photo_path = $row['profile_photo'];
    }



    // RESUME UPDATE

    if($_FILES['resume_pdf']['name'] != "")
    {
        $resume_name = $_FILES['resume_pdf']['name'];

        $resume_tmp = $_FILES['resume_pdf']['tmp_name'];

        $resume_ext = strtolower(pathinfo($resume_name, PATHINFO_EXTENSION));

        if($resume_ext != "pdf")
        {
            die("Only PDF allowed");
        }

        $resume_path = "uploads_resume/" . $resume_name;

        move_uploaded_file($resume_tmp, $resume_path);

        unlink($row['resume_pdf']);
    }
    else
    {
        $resume_path = $row['resume_pdf'];
    }



    // UPDATE QUERY

    $update = "UPDATE user
               SET name='$name',
               age='$age',
               city='$city',
               branch='$branch',
               profile_photo='$photo_path',
               resume_pdf='$resume_path'
               WHERE id='$id'";

    mysqli_query($conn,$update);

    header("Location:index.php");

    exit();
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Edit User</title>

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
            color:#111;
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
            margin-top:15px;
            font-weight:bold;
        }

        img{
            display:block;
            margin:20px auto;
            border-radius:10px;
            object-fit:cover;
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

        .back-btn{
            display:block;
            text-align:center;
            margin-top:15px;
            background:gray;
            color:white;
            padding:10px;
            border-radius:6px;
            text-decoration:none;
        }

        #preview{
            margin-top:15px;
            display:none;
        }

    </style>

</head>
<body>

<div class="form-box">

<h2>Edit User</h2>

<form method="POST"
      enctype="multipart/form-data">

    <input type="text"
           name="name"
           value="<?php echo $row['name']; ?>"
           required>

    <input type="number"
           name="age"
           value="<?php echo $row['age']; ?>"
           required>

    <input type="text"
           name="city"
           value="<?php echo $row['city']; ?>"
           required>

    <input type="text"
           name="branch"
           value="<?php echo $row['branch']; ?>"
           required>



    <label>Current Profile Photo</label>

    <img src="<?php echo $row['profile_photo']; ?>"
         width="120"
         height="120">



    <label>Upload New Profile Photo</label>

    <input type="file"
           name="profile_photo"
           accept=".jpg,.jpeg,.png"
           onchange="previewImage(event)">



    <img id="preview"
         width="120"
         height="120">



    <label>Upload New Resume PDF</label>

    <input type="file"
           name="resume_pdf"
           accept=".pdf">



    <button type="submit"
            name="update">
        Update User
    </button>



    <a href="index.php"
       class="back-btn">
       Back
    </a>

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
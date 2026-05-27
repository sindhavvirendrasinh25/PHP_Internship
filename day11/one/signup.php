<?php

include 'config.php';

if(isset($_POST['signup']))
{
    $username = $_POST['username'];

    $password = $_POST['password'];

    $check = "SELECT * FROM login
              WHERE username='$username'";

    $result = mysqli_query($conn,$check);

    if(mysqli_num_rows($result) > 0)
    {
        echo "<script>alert('Username Already Exists')</script>";
    }
    else
    {
        $insert = "INSERT INTO login(
                   username,
                   password
                   )

                   VALUES(
                   '$username',
                   '$password'
                   )";

        mysqli_query($conn,$insert);

        header("Location:login.php");

        exit();
    }
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Signup</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:Arial;
            background:linear-gradient(135deg,#ff416c,#ff4b2b);
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .box{
            width:350px;
            background:white;
            padding:30px;
            border-radius:15px;
            box-shadow:0 5px 20px rgba(0,0,0,0.3);
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

        button{
            width:100%;
            padding:12px;
            margin-top:18px;
            background:linear-gradient(45deg,#ff416c,#ff4b2b);
            color:white;
            border:none;
            border-radius:6px;
            cursor:pointer;
        }

        .login-link{
            text-align:center;
            margin-top:20px;
        }

        .login-link a{
            text-decoration:none;
            color:#ff416c;
            font-weight:bold;
        }

    </style>

</head>
<body>

<div class="box">

<h2>Signup</h2>

<form method="POST">

    <input type="text"
           name="username"
           placeholder="Enter Username"
           required>

    <input type="password"
           name="password"
           placeholder="Enter Password"
           required>

    <button type="submit"
            name="signup">
        Signup
    </button>

</form>

<div class="login-link">

    <a href="login.php">
        Already Have Account?
    </a>

</div>

</div>

</body>
</html>
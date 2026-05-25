<?php

include 'config.php';

if(isset($_POST['login']))
{
    $username = $_POST['username'];

    $password = $_POST['password'];

    $query = "SELECT * FROM login
              WHERE username='$username'
              AND password='$password'";

    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result) == 1)
    {
        $_SESSION['user'] = $username;

        header("Location: add.php");

        exit();
    }
    else
    {
        echo "<script>alert('Invalid Username or Password')</script>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Login</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:Arial, Helvetica, sans-serif;
            background:linear-gradient(135deg,#6a11cb,#2575fc);
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .login-box{
            width:380px;
            background:white;
            padding:35px;
            border-radius:15px;
            box-shadow:0 5px 20px rgba(0,0,0,0.3);
        }

        h2{
            text-align:center;
            margin-bottom:25px;
            font-size:35px;
            color:#111;
        }

        input{
            width:100%;
            padding:12px;
            margin-top:15px;
            border:1px solid #ccc;
            border-radius:6px;
            font-size:15px;
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

        .signup-link{
            text-align:center;
            margin-top:20px;
        }

        .signup-link a{
            text-decoration:none;
            color:#2575fc;
            font-weight:bold;
        }

    </style>

</head>
<body>

<div class="login-box">

<h2>Login</h2>

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
            name="login">
        Login
    </button>

</form>

<div class="signup-link">

    <a href="signup.php">
        Create New Account
    </a>

</div>

</div>

</body>
</html>
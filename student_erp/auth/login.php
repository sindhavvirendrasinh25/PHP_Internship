<?php

session_start();
include '../db.php';

$message = "";

if(isset($_POST['login']))
{
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1)
    {
        $user = mysqli_fetch_assoc($result);

        if(password_verify($password, $user['password']))
        {
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            if($user['role'] == 'admin')
            {
                header("Location: ../admin/dashboard.php");
                exit();
            }
            elseif($user['role'] == 'faculty')
            {
                header("Location: ../faculty/dashboard.php");
                exit();
            }
            else
            {
                header("Location: ../student/dashboard.php");
                exit();
            }
        }
        else
        {
            $message = "Invalid Password!";
        }
    }
    else
    {
        $message = "Email Not Found!";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="form-container">

    <h2>Login</h2>

    <?php
    if($message != "")
    {
        echo "<p class='msg'>$message</p>";
    }
    ?>

    <form method="POST">

        <input type="email"
               name="email"
               placeholder="Enter Email"
               required>

        <input type="password"
               name="password"
               placeholder="Enter Password"
               required>

        <button type="submit" name="login">
            Login
        </button>

    </form>

    <p>
        Don't have an account?
        <a href="register.php">Register</a>
    </p>

</div>

</body>
</html>
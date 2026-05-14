<?php

session_start();

$correctUser = "admin";
$correctPass = "Admin@123";

$username = "";
$userErr = $passErr = $loginErr = "";

if(!isset($_SESSION["attempt"])){

    $_SESSION["attempt"] = 0;
}

if(isset($_COOKIE["username"])){

    $username = $_COOKIE["username"];
}

if($_SESSION["attempt"] >= 3){

    $loginErr = "Account temporarily locked";
}

elseif($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Username Validation
    if(empty($username)){

        $userErr = "Username required";
    }
    elseif(strlen($username) < 3 || !ctype_alnum($username)){

        $userErr = "Min 3 chars & alphanumeric only";
    }

    // Password Validation
    if(empty($password)){

        $passErr = "Password required";
    }
    elseif(strlen($password) < 6){

        $passErr = "Min 6 chars";
    }

    // Login Check
    if(empty($userErr) && empty($passErr)){

        if($username == $correctUser && $password == $correctPass){

            $_SESSION["attempt"] = 0;

            if(isset($_POST["remember"])){

                setcookie("username",$username,time()+60*60*24*7);
            }

            $success = "Welcome $username";
        }

        else{

            $_SESSION["attempt"]++;

            $loginErr = "Invalid username or password";
        }
    }

}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Login Form</title>

    <style>

        body{
            font-family: Arial;
            background: #0f172a;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .box{
            background: white;
            width: 350px;
            padding: 25px;
            border-radius: 10px;
        }

        h2{
            text-align: center;
            color: darkblue;
        }

        input{
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        button{
            width: 100%;
            padding: 10px;
            background: darkblue;
            color: white;
            border: none;
            cursor: pointer;
        }

        .error{
            color: red;
            font-size: 14px;
        }

        .success{
            background: green;
            color: white;
            padding: 10px;
            text-align: center;
            margin-bottom: 10px;
        }

    </style>

</head>

<body>

<div class="box">

<h2>Login Form</h2>

<?php if(isset($success)){ ?>

<div class="success">

<?php echo $success; ?>

</div>

<?php } ?>

<div class="error">

<?php echo $loginErr; ?>

</div>

<form method="POST">

Username:

<input type="text" name="username" value="<?php echo $username; ?>">

<div class="error">

<?php echo $userErr; ?>

</div>

Password:

<input type="password" name="password">

<div class="error">

<?php echo $passErr; ?>

</div>

<label>

<input type="checkbox" name="remember">

Remember Me

</label>

<br><br>

<button type="submit">Login</button>

</form>

</div>

</body>
</html>
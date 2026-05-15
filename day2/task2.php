<?php

$name = $username = $email = $mobile = $password = $confirm = $city = $pincode = "";

$nameErr = $usernameErr = $emailErr = $mobileErr = $passwordErr = $confirmErr = $cityErr = $pincodeErr = "";

$passwordStrength = "";

$success = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $name = trim($_POST["name"]);
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $mobile = trim($_POST["mobile"]);
    $password = trim($_POST["password"]);
    $confirm = trim($_POST["confirm"]);
    $city = trim($_POST["city"]);
    $pincode = trim($_POST["pincode"]);

    // Name Validation
    if(empty($name)){
        $nameErr = "Name is required";
    }
    elseif(!preg_match("/^[a-zA-Z ]{3,}$/",$name)){
        $nameErr = "Only letters and spaces, min 3 chars";
    }

    // Username Validation
    if(empty($username)){
        $usernameErr = "Username required";
    }
    elseif(!preg_match("/^[a-zA-Z0-9_]{4,20}$/",$username)){
        $usernameErr = "4-20 chars, no spaces";
    }

    // Email Validation
    if(empty($email)){
        $emailErr = "Email required";
    }
    elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $emailErr = "Invalid Email";
    }

    // Mobile Validation
    if(empty($mobile)){
        $mobileErr = "Mobile required";
    }
    elseif(!preg_match("/^[6-9][0-9]{9}$/",$mobile)){
        $mobileErr = "Invalid Indian Mobile";
    }

    // Password Validation
    if(empty($password)){
        $passwordErr = "Password required";
    }
    elseif(!preg_match("/^(?=.*[A-Z])(?=.*[0-9])(?=.*[\W]).{8,}$/",$password)){
        $passwordErr = "Password must contain uppercase, number & special char";
    }

    // Password Strength
    if(strlen($password) < 6){
        $passwordStrength = "Weak";
    }
    elseif(strlen($password) < 8){
        $passwordStrength = "Medium";
    }
    elseif(preg_match("/[A-Z]/",$password) && preg_match("/[0-9]/",$password)){
        $passwordStrength = "Strong";
    }
    elseif(preg_match("/[A-Z]/",$password) && preg_match("/[0-9]/",$password) && preg_match("/[\W]/",$password)){
        $passwordStrength = "Very Strong";
    }

    // Confirm Password
    if($confirm != $password){
        $confirmErr = "Passwords do not match";
    }

    // City Validation
    if(empty($city)){
        $cityErr = "City required";
    }

    // Pincode Validation
    if(empty($pincode)){
        $pincodeErr = "Pincode required";
    }
    elseif(!preg_match("/^[1-9][0-9]{5}$/",$pincode)){
        $pincodeErr = "Invalid Pincode";
    }

    if(
        empty($nameErr) &&
        empty($usernameErr) &&
        empty($emailErr) &&
        empty($mobileErr) &&
        empty($passwordErr) &&
        empty($confirmErr) &&
        empty($cityErr) &&
        empty($pincodeErr)
    ){
        $success = true;
    }

}

?>

<!DOCTYPE html>
<html>
<head>

    <title>User Registration</title>

    <style>

        body{
            font-family: Arial;
            background: #f2f2f2;
            padding: 20px;
        }

        .container{
            width: 500px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        h2{
            text-align: center;
            color: darkblue;
        }

        input{
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .error{
            color: red;
            font-size: 14px;
        }

        .error-border{
            border: 2px solid red;
        }

        button{
            width: 100%;
            padding: 10px;
            background: darkblue;
            color: white;
            border: none;
            cursor: pointer;
        }

        .success{
            width: 500px;
            margin: auto;
            background: lightgreen;
            padding: 20px;
            border-radius: 10px;
        }

        .strength{
            font-weight: bold;
            color: purple;
        }

    </style>

</head>

<body>

<?php if($success){ ?>

<div class="success">

    <h2>Registration Successful</h2>

    <p><b>Name:</b> <?php echo htmlspecialchars($name); ?></p>

    <p><b>Username:</b> <?php echo htmlspecialchars($username); ?></p>

    <p><b>Email:</b> <?php echo htmlspecialchars($email); ?></p>

    <p><b>Mobile:</b> <?php echo htmlspecialchars($mobile); ?></p>

    <p><b>City:</b> <?php echo htmlspecialchars($city); ?></p>

    <p><b>Pincode:</b> <?php echo htmlspecialchars($pincode); ?></p>

</div>

<?php } else { ?>

<div class="container">

    <h2>Multi-Step User Registration</h2>

    <form method="POST">

        Full Name:

        <input type="text" name="name" value="<?php echo $name; ?>" class="<?php if($nameErr) echo 'error-border'; ?>">

        <div class="error"><?php echo $nameErr; ?></div>

        Username:

        <input type="text" name="username" value="<?php echo $username; ?>" class="<?php if($usernameErr) echo 'error-border'; ?>">

        <div class="error"><?php echo $usernameErr; ?></div>

        Email:

        <input type="text" name="email" value="<?php echo $email; ?>" class="<?php if($emailErr) echo 'error-border'; ?>">

        <div class="error"><?php echo $emailErr; ?></div>

        Mobile:

        <input type="text" name="mobile" value="<?php echo $mobile; ?>" class="<?php if($mobileErr) echo 'error-border'; ?>">

        <div class="error"><?php echo $mobileErr; ?></div>

        Password:

        <input type="password" name="password" class="<?php if($passwordErr) echo 'error-border'; ?>">

        <div class="error"><?php echo $passwordErr; ?></div>

        <div class="strength">

            Password Strength: <?php echo $passwordStrength; ?>

        </div>

        <br>

        Confirm Password:

        <input type="password" name="confirm" class="<?php if($confirmErr) echo 'error-border'; ?>">

        <div class="error"><?php echo $confirmErr; ?></div>

        City:

        <input type="text" name="city" value="<?php echo $city; ?>" class="<?php if($cityErr) echo 'error-border'; ?>">

        <div class="error"><?php echo $cityErr; ?></div>

        Pincode:

        <input type="text" name="pincode" value="<?php echo $pincode; ?>" class="<?php if($pincodeErr) echo 'error-border'; ?>">

        <div class="error"><?php echo $pincodeErr; ?></div>

        <br><br>

        <button type="submit">Register</button>

    </form>

</div>

<?php } ?>

</body>
</html>
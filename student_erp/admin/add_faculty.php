<?php

session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin')
{
    header("Location: ../auth/login.php");
    exit();
}

include '../db.php';

$msg = "";

if(isset($_POST['add']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $role = "faculty";

    $sql = "INSERT INTO users(name,email,password,role)
            VALUES('$name','$email','$password','$role')";

    if(mysqli_query($conn,$sql))
    {
        $msg = "Faculty Added Successfully";
    }
    else
    {
        $msg = "Error Adding Faculty";
    }
}

include '../includes/header.php';
include '../includes/navbar.php';

?>

<div class="form-container">

<h2>Add Faculty</h2>

<?php echo $msg; ?>

<form method="POST">

<input type="text"
name="name"
placeholder="Faculty Name"
required>

<input type="email"
name="email"
placeholder="Faculty Email"
required>

<input type="password"
name="password"
placeholder="Password"
required>

<button type="submit" name="add">
Add Faculty
</button>

</form>

</div>

<?php include '../includes/footer.php'; ?>
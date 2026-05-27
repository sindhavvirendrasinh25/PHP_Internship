<?php

session_start();

include 'db.php';

$message = "";

if(isset($_POST['login'])){

    $username = $_POST['username'];

    $password = $_POST['password'];

    $role = $_POST['role'];

    $sql = "SELECT * FROM social_media
            WHERE username='$username'
            AND role='$role'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_assoc($result);

        // CHECK APPROVAL

        if($row['status'] != "approved"){

            $message = "Waiting For Admin Approval";

        }else{

            if(password_verify($password,
               $row['password'])){

                $_SESSION['user'] = $row['name'];

                $_SESSION['role'] = $row['role'];

                $_SESSION['id'] = $row['id'];

                header("Location: dashboard.php");

                exit();

            }else{

                $message = "Wrong Password";
            }
        }

    }else{

        $message = "Invalid Username or Role";
    }
}

include 'header.php';

?>

<div class="form-body">

<div class="form-box">

    <h2>

        Login

    </h2>

    <p class="msg">

        <?php echo $message; ?>

    </p>

    <form method="POST">

        <input type="text"
               name="username"
               placeholder="Username"
               required>

        <input type="password"
               name="password"
               placeholder="Password"
               required>

        <select name="role"
                required>

            <option value="">

                Select Role

            </option>

            <option value="admin">

                Admin

            </option>

            <option value="user">

                User

            </option>

        </select>

        <button type="submit"
                name="login">

            Login

        </button>

        <a href="register.php"
           class="switch-link">

           Don't have an account? Register

        </a>

    </form>

</div>

</div>

<?php include 'footer.php'; ?>
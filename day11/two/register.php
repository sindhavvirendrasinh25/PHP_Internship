<?php

include 'db.php';

$message = "";

if(isset($_POST['register'])){

    $name = $_POST['name'];

    $username = $_POST['username'];

    $email = $_POST['email'];

    $password = $_POST['password'];

    // DEFAULT USER ROLE

    $role = "user";

    // DEFAULT STATUS

    $status = "pending";

    $hashed_password = password_hash($password,
                       PASSWORD_DEFAULT);

    $sql = "INSERT INTO social_media
            (name, username, password,
             email, role, status)

            VALUES

            ('$name', '$username',
             '$hashed_password',
             '$email',
             '$role',
             '$status')";

    $result = mysqli_query($conn, $sql);

    if($result){

        $message = "Request Sent To Admin";

    }else{

        $message = "Registration Failed";
    }
}

include 'header.php';

?>

<div class="form-body">

<div class="form-box">

    <h2>

        Create Account

    </h2>

    <p class="msg">

        <?php echo $message; ?>

    </p>

    <form method="POST">

        <input type="text"
               name="name"
               placeholder="Full Name"
               required>

        <input type="text"
               name="username"
               placeholder="Username"
               required>

        <input type="email"
               name="email"
               placeholder="Email"
               required>

        <input type="password"
               name="password"
               placeholder="Password"
               required>

        <button type="submit"
                name="register">

            Send Request

        </button>

        <a href="login.php"
           class="switch-link">

           Already have an account? Login

        </a>

    </form>

</div>

</div>

<?php include 'footer.php'; ?>
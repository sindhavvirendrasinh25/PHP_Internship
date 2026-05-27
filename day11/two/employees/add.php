<?php

session_start();

include '../db.php';

if($_SESSION['role'] != "admin"){

    echo "<script>

    alert('User cannot access this page');

    window.location='../dashboard.php';

    </script>";

    exit();
}

if(isset($_POST['add'])){

    $name = $_POST['name'];

    $username = $_POST['username'];

    $email = $_POST['email'];

    $password = $_POST['password'];

    $role = $_POST['role'];

    $hashed_password = password_hash($password,
                       PASSWORD_DEFAULT);

    // PROFILE PHOTO

    $profile_photo = $_FILES['profile']['name'];

    $profile_tmp = $_FILES['profile']['tmp_name'];

    move_uploaded_file($profile_tmp,
    "../uploads/profile/".$profile_photo);

    // DOCUMENT

    $document = $_FILES['document']['name'];

    $document_tmp = $_FILES['document']['tmp_name'];

    move_uploaded_file($document_tmp,
    "../uploads/documents/".$document);

    $sql = "INSERT INTO social_media
            (name, username, password, email,
             role, profile_photo, document_file)

            VALUES

            ('$name', '$username',
             '$hashed_password', '$email',
             '$role', '$profile_photo',
             '$document')";

    mysqli_query($conn, $sql);

    header("Location: view.php");

    exit();
}

include '../header.php';

?>

<div class="form-body">

<div class="form-container">

    <h2>Add User</h2>

    <form method="POST"
          enctype="multipart/form-data">

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

        <select name="role" required>

            <option value="">Select Role</option>

            <option value="admin">

                Admin

            </option>

            <option value="user">

                User

            </option>

        </select>

        <label>

            Upload Profile Photo

        </label>

        <input type="file"
               name="profile"
               required>

        <label>

            Upload Document

        </label>

        <input type="file"
               name="document"
               required>

        <button type="submit"
                name="add">

            Add User

        </button>

    </form>

</div>

</div>

<?php include '../footer.php'; ?>
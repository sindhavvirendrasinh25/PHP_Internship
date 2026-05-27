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

$id = $_GET['id'];

$sql = "SELECT * FROM social_media
        WHERE id='$id'";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $name = $_POST['name'];

    $username = $_POST['username'];

    $email = $_POST['email'];

    $role = $_POST['role'];

    // PROFILE UPDATE

    $profile_photo = $_FILES['profile']['name'];

    if($profile_photo != ""){

        $profile_tmp = $_FILES['profile']['tmp_name'];

        move_uploaded_file($profile_tmp,
        "../uploads/profile/".$profile_photo);

    }else{

        $profile_photo = $row['profile_photo'];
    }

    // DOCUMENT UPDATE

    $document = $_FILES['document']['name'];

    if($document != ""){

        $document_tmp = $_FILES['document']['tmp_name'];

        move_uploaded_file($document_tmp,
        "../uploads/documents/".$document);

    }else{

        $document = $row['document_file'];
    }

    $update = "UPDATE social_media

               SET

               name='$name',
               username='$username',
               email='$email',
               role='$role',
               profile_photo='$profile_photo',
               document_file='$document'

               WHERE id='$id'";

    mysqli_query($conn, $update);

    header("Location: view.php");

    exit();
}

include '../header.php';

?>

<div class="form-body">

<div class="form-container">

    <h2>Edit User</h2>

    <form method="POST"
          enctype="multipart/form-data">

        <input type="text"
               name="name"
               value="<?php echo $row['name']; ?>"
               required>

        <input type="text"
               name="username"
               value="<?php echo $row['username']; ?>"
               required>

        <input type="email"
               name="email"
               value="<?php echo $row['email']; ?>"
               required>

        <select name="role">

            <option value="admin"
            <?php
            if($row['role']=="admin")
            echo "selected";
            ?>>

            Admin

            </option>

            <option value="user"
            <?php
            if($row['role']=="user")
            echo "selected";
            ?>>

            User

            </option>

        </select>

        <label>

            Current Profile Photo

        </label>

        <br><br>

        <img src="../uploads/profile/<?php echo $row['profile_photo']; ?>"
             class="table-img">

        <br><br>

        <input type="file"
               name="profile">

        <label>

            Upload New Document

        </label>

        <input type="file"
               name="document">

        <button type="submit"
                name="update">

            Update User

        </button>

    </form>

</div>

</div>

<?php include '../footer.php'; ?>
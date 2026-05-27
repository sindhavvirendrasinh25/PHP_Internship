<?php

session_start();

include 'db.php';

if(!isset($_SESSION['user'])){

    header("Location: login.php");

    exit();
}

$id = $_SESSION['id'];

// FETCH USER

$sql = "SELECT * FROM social_media
        WHERE id='$id'";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

// UPDATE PROFILE PHOTO

if(isset($_POST['upload'])){

    $profile_photo = $_FILES['profile']['name'];

    $tmp_name = $_FILES['profile']['tmp_name'];

    move_uploaded_file($tmp_name,
    "uploads/profile/".$profile_photo);

    $update = "UPDATE social_media

               SET profile_photo='$profile_photo'

               WHERE id='$id'";

    mysqli_query($conn, $update);

    header("Location: profile.php");

    exit();
}

include 'header.php';

?>

<div class="profile-page">

<div class="profile-card-main">

<?php

if($row['profile_photo'] != ""){

?>

<img src="uploads/profile/<?php echo $row['profile_photo']; ?>"
     class="profile-img">

<?php } else { ?>

<img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
     class="profile-img">

<?php } ?>

<h1>

    <?php echo $row['name']; ?>

</h1>

<p>

    Username :
    <?php echo $row['username']; ?>

</p>

<p>

    Email :
    <?php echo $row['email']; ?>

</p>

<p>

    Role :
    <?php echo $row['role']; ?>

</p>

<!-- PHOTO UPLOAD FORM -->

<form method="POST"
      enctype="multipart/form-data">

    <input type="file"
           name="profile"
           required>

    <button type="submit"
            name="upload"
            class="upload-btn">

        Upload Profile Photo

    </button>

</form>

</div>

</div>

<?php include 'footer.php'; ?>
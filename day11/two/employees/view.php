<?php

session_start();

include '../db.php';

// ONLY ADMIN ACCESS

if($_SESSION['role'] != "admin"){

    echo "<script>

    alert('User cannot access this page');

    window.location='../dashboard.php';

    </script>";

    exit();
}

// FETCH USERS

$sql = "SELECT * FROM social_media";

$result = mysqli_query($conn, $sql);

include '../header.php';

?>

<div class="table-page">

<h2>

    All Users

</h2>

<a href="add.php"
   class="main-btn">

   ➕ Add User

</a>

<table>

<tr>

    <th>Photo</th>

    <th>Name</th>

    <th>Username</th>

    <th>Email</th>

    <th>Role</th>

    <th>Status</th>

    <th>Document</th>

    <th>Approve</th>

    <th>Action</th>

</tr>

<?php

while($row = mysqli_fetch_assoc($result)){

?>

<tr>

    <!-- PROFILE PHOTO -->

    <td>

        <img src="../uploads/profile/<?php echo $row['profile_photo']; ?>"
             class="table-img">

    </td>

    <!-- NAME -->

    <td>

        <?php echo $row['name']; ?>

    </td>

    <!-- USERNAME -->

    <td>

        <?php echo $row['username']; ?>

    </td>

    <!-- EMAIL -->

    <td>

        <?php echo $row['email']; ?>

    </td>

    <!-- ROLE -->

    <td>

        <?php echo $row['role']; ?>

    </td>

    <!-- STATUS -->

    <td>

        <?php echo $row['status']; ?>

    </td>

    <!-- DOCUMENT -->

    <td>

        <a href="../uploads/documents/<?php echo $row['document_file']; ?>"
           target="_blank">

           View File

        </a>

    </td>

    <!-- APPROVE -->

    <td>

    <?php

    if($row['status']=="pending"){

    ?>

    <a href="approve.php?id=<?php echo $row['id']; ?>"
       class="main-btn">

       Approve

    </a>

    <?php

    }else{

        echo "Approved";
    }

    ?>

    </td>

    <!-- ACTION -->

    <td>

        <a href="edit.php?id=<?php echo $row['id']; ?>">

            Edit

        </a>

        |

        <a href="delete.php?id=<?php echo $row['id']; ?>"
           onclick="return confirm('Delete User?')">

            Delete

        </a>

    </td>

</tr>

<?php } ?>

</table>

</div>

<?php include '../footer.php'; ?>
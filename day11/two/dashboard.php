<?php

session_start();

include 'db.php';

if(!isset($_SESSION['user'])){

    header("Location: login.php");

    exit();
}

// TOTAL USERS

$total_sql = "SELECT COUNT(*) as total
              FROM social_media";

$total_result = mysqli_query($conn,
                $total_sql);

$total_users = mysqli_fetch_assoc($total_result);

// PENDING USERS

$pending_sql = "SELECT * FROM social_media
                WHERE status='pending'";

$pending_result = mysqli_query($conn,
                  $pending_sql);

include 'header.php';

?>

<script>

history.pushState(null, null, location.href);

window.onpopstate = function () {

    history.go(1);

};

</script>

<div class="dashboard-main">

<!-- SIDEBAR -->

<div class="sidebar">

<?php

if($_SESSION['role']=="admin"){

?>

    <h2>

        Admin Panel

    </h2>

    <a href="dashboard.php">

        🏠 Dashboard

    </a>

    <a href="employees/view.php">

        👥 Manage Users

    </a>

    <a href="employees/add.php">

        ➕ Add User

    </a>

    <a href="profile.php">

        👤 Profile

    </a>

    <a href="logout.php">

        🚪 Logout

    </a>

<?php } else { ?>

    <h2>

        User Panel

    </h2>

    <a href="dashboard.php">

        🏠 Dashboard

    </a>

    <a href="profile.php">

        👤 My Profile

    </a>

    <a href="logout.php">

        🚪 Logout

    </a>

<?php } ?>

</div>

<!-- CONTENT -->

<div class="dashboard-content">

<?php

if($_SESSION['role']=="admin"){

?>

    <!-- ADMIN SECTION -->

    <h1>

        Welcome Admin,
        <?php echo $_SESSION['user']; ?>

    </h1>

    <!-- PROFILE CARD -->

    <div class="profile-card">

        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png">

        <h3>

            <?php echo $_SESSION['user']; ?>

        </h3>

        <p>

            Role :
            <?php echo $_SESSION['role']; ?>

        </p>

    </div>

    <!-- DASHBOARD CARDS -->

    <div class="dashboard-cards">

        <div class="card">

            <h2>

                <?php echo $total_users['total']; ?>

            </h2>

            <p>

                Total Users

            </p>

        </div>

        <div class="card">

            <h2>

                ADMIN

            </h2>

            <p>

                Full Access

            </p>

        </div>

        <div class="card">

            <h2>

                Secure

            </h2>

            <p>

                Authentication System

            </p>

        </div>

    </div>

    <!-- QUICK LINKS -->

    <div class="quick-links">

        <a href="employees/add.php">

            ➕ Add User

        </a>

        <a href="employees/view.php">

            👥 Manage Users

        </a>

    </div>

    <!-- PENDING REQUESTS -->

    <div class="request-box">

        <h2>

            Pending User Requests

        </h2>

        <table>

            <tr>

                <th>Name</th>

                <th>Username</th>

                <th>Email</th>

                <th>Approve</th>

            </tr>

            <?php

            while($pending =
                  mysqli_fetch_assoc($pending_result)){

            ?>

            <tr>

                <td>

                    <?php echo $pending['name']; ?>

                </td>

                <td>

                    <?php echo $pending['username']; ?>

                </td>

                <td>

                    <?php echo $pending['email']; ?>

                </td>

                <td>

                    <a href="employees/approve.php?id=<?php echo $pending['id']; ?>"
                       class="main-btn">

                       Approve

                    </a>

                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

<?php } else { ?>

    <!-- USER SECTION -->

    <h1>

        Welcome User,
        <?php echo $_SESSION['user']; ?>

    </h1>

    <!-- USER PROFILE -->

    <div class="profile-card">

        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png">

        <h3>

            <?php echo $_SESSION['user']; ?>

        </h3>

        <p>

            Role :
            <?php echo $_SESSION['role']; ?>

        </p>

    </div>

    <!-- USER CARD -->

    <div class="dashboard-cards">

        <div class="card">

            <h2>

                USER

            </h2>

            <p>

                Limited Access

            </p>

        </div>

    </div>

<?php } ?>

</div>

</div>

<?php include 'footer.php'; ?>
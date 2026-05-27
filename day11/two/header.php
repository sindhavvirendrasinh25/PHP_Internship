<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Social Media System</title>

    <?php

    $current_folder = basename(dirname($_SERVER['PHP_SELF']));

    if($current_folder == "employees"){

        echo '<link rel="stylesheet" href="../style.css">';

    }else{

        echo '<link rel="stylesheet" href="style.css">';

    }

    ?>

</head>

<body>

<?php

$current_page = basename($_SERVER['PHP_SELF']);

if($current_page != "login.php" &&
   $current_page != "register.php"){

?>

<!-- HEADER -->

<div class="header">

    <div class="logo">

        Social Media System

    </div>

    <div class="nav">

        <a href="/PHP_Internship/day11/two/dashboard.php">

            Dashboard

        </a>

        <a href="/PHP_Internship/day11/two/employees/view.php">

            Users

        </a>

        <a href="/PHP_Internship/day11/two/profile.php">

            Profile

        </a>

        <a href="/PHP_Internship/day11/two/logout.php">

            Logout

        </a>

    </div>

</div>

<?php } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background: white;
            margin: 0;
            padding: 20px;
        }

        .container{
            width: 80%;
            margin: auto;
        }

        .box{
            background: pink;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            border-left: 6px solid magenta;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        h1{
            color: purple;
        }

        ul{
            padding-left: 20px;
        }

        footer{
            text-align: center;
            background: greenyellow;
            color: black;
            padding: 15px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<?php

// Variables
$name = "Virendrasinh";
$city = "Anand";
$hobby = "Playing Cricket";

// Date & Time
$date = date("d M Y");
$time = date("h:i A");

// Dynamic Greeting
$hour = date("H");

if($hour < 12){
    $greeting = "Good Morning";
}
elseif($hour < 18){
    $greeting = "Good Afternoon";
}
else{
    $greeting = "Good Evening";
}

// Day Message
$day = date("l");

if($day == "Tuesday"){
    $message = "Enjoy Php Session!";
}
else{
    $message = "Keep grinding!";
}

?>

<div class="container">

    <!-- Section 1 -->
    <div class="box">
        <h1><?php echo $greeting; ?> </h1>
        <p><strong>Name:</strong> <?php echo $name; ?></p>
        <p><strong>City:</strong> <?php echo $city; ?></p>
        <p><strong>Hobby:</strong> <?php echo $hobby; ?></p>
    </div>

    <!-- Section 2 -->
    <div class="box">
        <h2>Current Date & Time</h2>
        <p>Date: <?php echo $date; ?></p>
        <p>Time: <?php echo $time; ?></p>
    </div>

    <!-- Section 3 -->
    <div class="box">
        <h2>Today's Message</h2>
        <p><?php echo $message; ?></p>
    </div>

    <!-- Skills Section -->
    <div class="box">
        <h2>Skills I Want to Learn</h2>

        <ul>
         
            <li>PHP </li>
            <li>Html,css</li>
            <li>MySQL </li>
            <li>Python</li>
        </ul>
    </div>

    <!-- Footer -->
    <footer>
    © <?php echo date("Y"); ?> Virendrasinh. All Rights Reserved.
</footer>

</div>

</body>
</html>
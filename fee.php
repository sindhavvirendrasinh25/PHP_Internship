<!DOCTYPE html>
<html>
<head>
    <title>Student Fee Receipt</title>

    <style>

        body{
            font-family: Arial;
            background:#f2f2f2;
        }

        .box{
            width:500px;
            background:white;
            padding:20px;
            margin:40px auto;
            border-radius:10px;
        }

        h2{
            text-align:center;
            color:darkblue;
        }

        input,select{
            width:100%;
            padding:10px;
            margin-top:10px;
        }

        button{
            padding:10px 20px;
            background:darkblue;
            color:white;
            border:none;
            margin-top:15px;
            cursor:pointer;
        }

        .receipt{
            margin-top:20px;
            background:#f9f9f9;
            padding:15px;
            border-radius:10px;
        }

    </style>
</head>

<body>

<div class="box">

<h2>Student Fee Receipt</h2>

<form method="GET">

    <input type="text" name="name" placeholder="Enter Name" required>

    <input type="text" name="roll" placeholder="Enter Roll No" required>

    <select name="course" required>
        <option value="">Select Course</option>
        <option value="BCA">BCA</option>
        <option value="MCA">MCA</option>
        <option value="BTech">BTech</option>
        <option value="MBA">MBA</option>
    </select>

    <input type="number" name="semester" placeholder="Enter Semester" required>

    <input type="number" name="marks" placeholder="Enter Marks" required>

    <button type="submit">Generate Receipt</button>

</form>

<?php

if(isset($_GET['name']))
{
    $name = htmlspecialchars($_GET['name']);
    $roll = htmlspecialchars($_GET['roll']);
    $course = htmlspecialchars($_GET['course']);
    $semester = htmlspecialchars($_GET['semester']);
    $marks = htmlspecialchars($_GET['marks']);

    // Course Fee using switch

    switch($course)
    {
        case "BCA":
            $fee = 25000;
            break;

        case "MCA":
            $fee = 40000;
            break;

        case "BTech":
            $fee = 55000;
            break;

        case "MBA":
            $fee = 60000;
            break;

        default:
            $fee = 0;
    }

    // Scholarship Discount

    if($marks >= 90)
    {
        $discount = $fee * 0.30;
    }
    elseif($marks >= 75)
    {
        $discount = $fee * 0.20;
    }
    elseif($marks >= 60)
    {
        $discount = $fee * 0.10;
    }
    else
    {
        $discount = 0;
    }

    // Late Fee Bonus

    $lateFee = 0;

    if($semester > 4 && $course == "MCA")
    {
        $lateFee = 2000;
    }

    // Final Fee

    $finalFee = $fee - $discount + $lateFee;

    echo "<div class='receipt'>";

    echo "<h3>Receipt</h3>";

    echo "Name : $name <br><br>";
    echo "Roll No : $roll <br><br>";
    echo "Course : $course <br><br>";
    echo "Semester : $semester <br><br>";
    echo "Marks : $marks <br><br>";

    echo "Base Fee : Rs.$fee <br><br>";
    echo "Discount : Rs.$discount <br><br>";
    echo "Late Fee : Rs.$lateFee <br><br>";

    echo "<b>Final Fee Payable : Rs.$finalFee</b>";

    echo "<br><br>";

    echo "<button onclick='window.print()'>Print</button>";

    echo "</div>";
}

?>

</div>

</body>
</html>
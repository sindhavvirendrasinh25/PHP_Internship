<!DOCTYPE html>
<html>
<head>
    <title>BMI Calculator</title>

    <style>

        body{
            font-family: Arial;
            background-color: #f2f2f2;
        }

        .box{
            width: 350px;
            background: white;
            padding: 20px;
            margin: 80px auto;
            border-radius: 10px;
            text-align: center;
        }

        h2{
            color: darkblue;
        }

        input{
            width: 90%;
            padding: 10px;
            margin-top: 10px;
        }

        button{
            padding: 10px 20px;
            background: darkblue;
            color: white;
            border: none;
            margin-top: 15px;
        }

        .result{
            margin-top: 20px;
            font-size: 20px;
            font-weight: bold;
        }

    </style>
</head>

<body>

<div class="box">

    <h2>BMI Calculator</h2>

    <form method="post">

        <input type="text" name="weight" placeholder="Enter Weight in KG">

        <input type="text" name="height" placeholder="Enter Height in CM">

        <button type="submit">Calculate</button>

    </form>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $weight = $_POST['weight'];
    $height = $_POST['height'];

    // Convert CM to Meter
    $height = $height / 100;

    // BMI Formula
    $bmi = $weight / ($height * $height);

    echo "<div class='result'>";

    echo "BMI = " . round($bmi,2) . "<br><br>";

    if($bmi < 18.5)
    {
        echo "<span style='color:blue'>Underweight</span><br>";
        echo "Color Indicator : Blue";
    }
    elseif($bmi < 25)
    {
        echo "<span style='color:green'>Normal Weight</span><br>";
        echo "Color Indicator : Green";
    }
    elseif($bmi < 30)
    {
        echo "<span style='color:orange'>Overweight</span><br>";
        echo "Color Indicator : Orange";
    }
    elseif($bmi < 35)
    {
        echo "<span style='color:darkorange'>Obese (Class I)</span><br>";
        echo "Color Indicator : Dark Orange";
    }
    else
    {
        echo "<span style='color:red'>Obese (Class II+)</span><br>";
        echo "Color Indicator : Red";
    }

    echo "</div>";
}

?>

</div>

</body>
</html>
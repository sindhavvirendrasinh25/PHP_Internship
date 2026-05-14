<?php

$result = "";
$color = "";
$message = "";
$reasons = [];

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $name = $_POST["name"];
    $age = $_POST["age"];
    $income = $_POST["income"];
    $credit = $_POST["credit"];
    $loan = $_POST["loan"];
    $amount = $_POST["amount"];

    switch($loan){

        case "Home":
            $rate = 8;
            $limit = 5000000;
            $years = 20;
        break;

        case "Car":
            $rate = 10;
            $limit = 1000000;
            $years = 7;
        break;

        default:
            $rate = 12;
            $limit = 500000;
            $years = 5;
    }

    $r = ($rate/12)/100;

    $n = $years*12;

    $emi = ($amount*$r*pow(1+$r,$n))/(pow(1+$r,$n)-1);

    $total = $emi*$n;

    $interest = $total-$amount;

    if($credit>=700 && $age<60 && $amount<=$limit){

        $result = "APPROVED";
        $message = "You are Eligible for Loan";
        $color = "green";

        $reasons[] = "Good credit score";
    }

    elseif(($credit>=600 && $credit<700) || ($income >= $emi*0.8)){

        $result = "CONDITIONAL";
        $message = "You are Conditionally Eligible for Loan";
        $color = "orange";

        if($credit<700){
            $reasons[] = "Increase credit score";
        }

        if($income < $emi){
            $reasons[] = "Increase income";
        }
    }

    else{

        $result = "REJECTED";
        $message = "You are Not Eligible for Loan";
        $color = "red";

        if($credit<600){
            $reasons[] = "Low credit score";
        }

        if($age>60){
            $reasons[] = "Age above limit";
        }

        if($amount > ($income*12*5)){
            $reasons[] = "Loan amount too high";
        }
    }

}

?>

<!DOCTYPE html>
<html>
<head>

<title>Loan Eligibility Checker</title>

<style>

body{
    font-family:Arial;
    background:#f2f2f2;
    padding:20px;
}

form,table,.box{
    background:white;
    padding:20px;
    margin:auto;
    width:500px;
    margin-bottom:20px;
    border-radius:10px;
}

h2{
    text-align:center;
    color:purple;
}

input,select{
    width:100%;
    padding:10px;
    margin:5px 0;
}

button{
    width:100%;
    padding:10px;
    background:purple;
    color:white;
    border:none;
    cursor:pointer;
}

.banner{
    color:white;
    padding:15px;
    text-align:center;
    font-size:20px;
    border-radius:10px;
    width:500px;
    margin:auto;
    margin-bottom:20px;
}

</style>

</head>

<body>

<form method="POST">

<h2>Loan Eligibility Checker</h2>

<input type="text" name="name" placeholder="Full Name" required>

<input type="number" name="age" placeholder="Age" required>

<input type="number" name="income" placeholder="Monthly Income" required>

<input type="number" name="credit" placeholder="Credit Score" required>

<input type="number" name="amount" placeholder="Loan Amount" required>

<select name="loan">

<option>Home</option>

<option>Car</option>

<option>Personal</option>

</select>

<button type="submit">Check Eligibility</button>

</form>

<?php if($result!=""){ ?>

<div class="banner" style="background:<?php echo $color; ?>">

<?php echo $message; ?>

</div>

<table border="1">

<tr>

<td>Name</td>

<td><?php echo $name; ?></td>

</tr>

<tr>

<td>Loan Type</td>

<td><?php echo $loan; ?></td>

</tr>

<tr>

<td>Loan Amount</td>

<td>₹<?php echo number_format($amount); ?></td>

</tr>

<tr>

<td>Interest Rate</td>

<td><?php echo $rate; ?>%</td>

</tr>

<tr>

<td>Tenure</td>

<td><?php echo $years; ?> Years</td>

</tr>

<tr>

<td>Monthly EMI</td>

<td>₹<?php echo number_format($emi,2); ?></td>

</tr>

<tr>

<td>Total Payable</td>

<td>₹<?php echo number_format($total,2); ?></td>

</tr>

<tr>

<td>Total Interest</td>

<td>₹<?php echo number_format($interest,2); ?></td>

</tr>

</table>

<div class="box">

<h3>Reasons</h3>

<ul>

<?php

foreach($reasons as $r){

    echo "<li>$r</li>";
}

?>

</ul>

</div>

<?php } ?>

</body>
</html>
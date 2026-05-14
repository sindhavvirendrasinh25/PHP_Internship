<!DOCTYPE html>
<html>
<head>
    <title>PHP Loops</title>
</head>
<body>

<?php

echo "<h2>For Loop</h2>";

for($i = 10; $i >= 5; $i--){
    echo $i . "<br>";
}


echo "<h2>While Loop</h2>";

$j = 8;

while($j >= 5){
    echo $j . "<br>";
    $j--;
}


echo "<h2>Do While Loop</h2>";

$k = 1;

do{
    echo $k . "<br>";
    $k++;
}
while($k <= 5);


echo "<h2>Foreach Loop</h2>";

$colors = ["Red", "Blue", "Green", "Black"];

foreach($colors as $color){
    echo $color . "<br>";
}

?>

</body>
</html>
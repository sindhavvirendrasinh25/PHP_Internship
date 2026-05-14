<!DOCTYPE html>
<html>
<head>
    <title>PHP Arrays</title>
</head>
<body>

<?php

// Indexed Array
echo "<h2>Indexed Array</h2>";

$colors = ["Red", "Blue", "Green"];

echo $colors[2] . "<br>";
echo $colors[0] . "<br>";
echo $colors[1] . "<br>";


// Associative Array
echo "<h2>Associative Array</h2>";

$student = [
    "name" => "Virendrasinh",
    "city" => "junagadh",
    "age" => 21
];

echo "Name: " . $student["name"] . "<br>";
echo "City: " . $student["city"] . "<br>";
echo "Age: " . $student["age"] . "<br>";


// Multidimensional Array
echo "<h2>Multidimensional Array</h2>";

$students = [

    ["Virendrasinh", "Ahmedabad", 21],

    ["Rahul", "Surat", 18],

    ["Priya", "Rajkot", 20]

];

echo $students[0][0] . " - " . $students[0][1] . " - " . $students[0][2] . "<br>";

echo $students[1][0] . " - " . $students[1][1] . " - " . $students[1][2] . "<br>";

echo $students[2][0] . " - " . $students[2][1] . " - " . $students[2][2] . "<br>";

?>

</body>
</html>
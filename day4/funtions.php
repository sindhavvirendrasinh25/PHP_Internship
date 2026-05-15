<?php

// Function with Parameters and Return Value
function addNumbers($a, $b)
{
    return $a + $b;
}

$result = addNumbers(10, 20);

echo "<h2>Function with Parameters and Return Value</h2>";
echo "Addition = " . $result . "<br><br>";


// Built-in String Functions
$str = "Virendrasinh";

echo "<h2>Built-in String Functions</h2>";

echo "Original String: " . $str . "<br>";
echo "Length: " . strlen($str) . "<br>";
echo "Uppercase: " . strtoupper($str) . "<br>";
echo "Lowercase: " . strtolower($str) . "<br>";
echo "Replace PHP with World: " . str_replace("PHP", "World", $str) . "<br>";
echo "Substring: " . substr($str, 0, 3) . "<br><br>";


// Built-in Math Functions
$num = 25.7;

echo "<h2>Built-in Math Functions</h2>";

echo "Original Number: " . $num . "<br>";
echo "Absolute Value: " . abs($num) . "<br>";
echo "Square Root of 25: " . sqrt(25) . "<br>";
echo "2 Power 3: " . pow(2, 3) . "<br>";
echo "Rounded Value: " . round($num) . "<br>";
echo "Random Number: " . rand(1, 100) . "<br>";

?>
<?php

$students = [

    ["roll"=>1,"name"=>"Viren","city"=>"Ahmedabad","php"=>85,"mysql"=>78,"html"=>90,"js"=>88,"python"=>80],

    ["roll"=>2,"name"=>"Rahul","city"=>"Surat","php"=>70,"mysql"=>65,"html"=>75,"js"=>72,"python"=>68],

    ["roll"=>3,"name"=>"Priya","city"=>"Rajkot","php"=>95,"mysql"=>92,"html"=>94,"js"=>91,"python"=>96],

    ["roll"=>4,"name"=>"Amit","city"=>"Vadodara","php"=>60,"mysql"=>58,"html"=>55,"js"=>62,"python"=>59],

    ["roll"=>5,"name"=>"Sneha","city"=>"Bhavnagar","php"=>88,"mysql"=>84,"html"=>86,"js"=>90,"python"=>85],

    ["roll"=>6,"name"=>"Karan","city"=>"Jamnagar","php"=>45,"mysql"=>50,"html"=>48,"js"=>52,"python"=>47],

    ["roll"=>7,"name"=>"Neha","city"=>"Anand","php"=>76,"mysql"=>79,"html"=>74,"js"=>80,"python"=>78],

    ["roll"=>8,"name"=>"Ravi","city"=>"Gandhinagar","php"=>35,"mysql"=>40,"html"=>38,"js"=>42,"python"=>36]

];

foreach($students as &$s){

    $total = $s["php"] + $s["mysql"] + $s["html"] + $s["js"] + $s["python"];

    $percentage = $total / 5;

    $s["total"] = $total;
    $s["percentage"] = $percentage;

    if($percentage >= 90){
        $grade = "A+";
    }
    elseif($percentage >= 75){
        $grade = "A";
    }
    elseif($percentage >= 60){
        $grade = "B";
    }
    elseif($percentage >= 40){
        $grade = "C";
    }
    else{
        $grade = "F";
    }

    $s["grade"] = $grade;
}

usort($students, function($a,$b){
    return $b["percentage"] <=> $a["percentage"];
});

$percentages = array_column($students,"percentage");

$classAverage = array_sum($percentages) / count($students);

$highest = max($percentages);

$lowest = min($percentages);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Result Sheet</title>
</head>

<body>

<h2>Student Result Sheet</h2>

<table border="1" cellpadding="10">

<tr>

    <th>Rank</th>
    <th>Roll No</th>
    <th>Name</th>
    <th>City</th>
    <th>PHP</th>
    <th>MySQL</th>
    <th>HTML</th>
    <th>JS</th>
    <th>Python</th>
    <th>Total</th>
    <th>Percentage</th>
    <th>Grade</th>

</tr>

<?php

$rank = 1;

foreach($students as $s){

    if($s["percentage"] >= 40){

?>

<tr>

    <td><?php echo $rank; ?></td>
    <td><?php echo $s["roll"]; ?></td>
    <td><?php echo $s["name"]; ?></td>
    <td><?php echo $s["city"]; ?></td>
    <td><?php echo $s["php"]; ?></td>
    <td><?php echo $s["mysql"]; ?></td>
    <td><?php echo $s["html"]; ?></td>
    <td><?php echo $s["js"]; ?></td>
    <td><?php echo $s["python"]; ?></td>
    <td><?php echo $s["total"]; ?></td>
    <td><?php echo number_format($s["percentage"],2); ?>%</td>
    <td><?php echo $s["grade"]; ?></td>

</tr>

<?php

    }

    $rank++;
}

?>

<tr>

    <td colspan="10"><b>Class Average</b></td>
    <td colspan="2"><?php echo number_format($classAverage,2); ?>%</td>

</tr>

<tr>

    <td colspan="10"><b>Highest Score</b></td>
    <td colspan="2"><?php echo $highest; ?>%</td>

</tr>

<tr>

    <td colspan="10"><b>Lowest Score</b></td>
    <td colspan="2"><?php echo $lowest; ?>%</td>

</tr>

</table>

</body>
</html>
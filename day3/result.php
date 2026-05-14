<?php

$students = [

    ["roll"=>1,"name"=>"Virendrasinh","city"=>"Junagadh","php"=>95,"mysql"=>98,"html"=>92,"js"=>95,"python"=>94],

    ["roll"=>2,"name"=>"Rahul","city"=>"Surat","php"=>70,"mysql"=>65,"html"=>75,"js"=>72,"python"=>68],

    ["roll"=>3,"name"=>"Priya","city"=>"Rajkot","php"=>95,"mysql"=>92,"html"=>94,"js"=>91,"python"=>96],

    ["roll"=>4,"name"=>"Amit","city"=>"Vadodara","php"=>60,"mysql"=>58,"html"=>55,"js"=>62,"python"=>59],

    ["roll"=>5,"name"=>"Sneha","city"=>"Bhavnagar","php"=>88,"mysql"=>84,"html"=>86,"js"=>90,"python"=>85],

    ["roll"=>6,"name"=>"Karan","city"=>"Jamnagar","php"=>45,"mysql"=>40,"html"=>42,"js"=>52,"python"=>47],

    ["roll"=>7,"name"=>"Neha","city"=>"Anand","php"=>76,"mysql"=>79,"html"=>74,"js"=>80,"python"=>78],

    ["roll"=>8,"name"=>"Ravi","city"=>"Gandhinagar","php"=>55,"mysql"=>45,"html"=>70,"js"=>65,"python"=>63]

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

    <style>

        body{
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 20px;
        }

        h1{
            text-align: center;
            color: teal;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        th{
            background: teal;
            color: white;
            padding: 12px;
        }

        td{
            padding: 10px;
            text-align: center;
        }

        tr:nth-child(even){
            background: #f9f9f9;
        }

        tr:hover{
            background: #e6f7ff;
        }

        .gold{
            background: gold !important;
        }

        .silver{
            background: silver !important;
        }

        .bronze{
            background: #cd7f32 !important;
            color: white;
        }

        .summary{
            background: lightblue;
            font-weight: bold;
        }

    </style>

</head>

<body>

<h1>Student Result Sheet Generator</h1>

<table border="1">

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

        $class = "";

        if($rank == 1){
            $class = "gold";
        }
        elseif($rank == 2){
            $class = "silver";
        }
        elseif($rank == 3){
            $class = "bronze";
        }

?>

<tr class="<?php echo $class; ?>">

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

<tr class="summary">

    <td colspan="10">Class Average</td>
    <td colspan="2"><?php echo number_format($classAverage,2); ?>%</td>

</tr>

<tr class="summary">

    <td colspan="10">Highest Score</td>
    <td colspan="2"><?php echo $highest; ?>%</td>

</tr>

<tr class="summary">

    <td colspan="10">Lowest Score</td>
    <td colspan="2"><?php echo $lowest; ?>%</td>

</tr>

</table>

</body>
</html>
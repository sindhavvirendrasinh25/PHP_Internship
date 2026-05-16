<?php

include 'config.php';

// Query
$sql = "SELECT * FROM student";

// Execute query
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Records</title>

    <style>

        body{
            font-family: Arial;
            background: #f3f0ed;
            padding: 20px;
        }

        h2{
            text-align: center;
            color: #50b8ec;
        }

        table{
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            background: white;
        }

        th{
            background: #e68991;
            color: white;
            padding: 12px;
        }

        td{
            padding: 10px;
            text-align: center;
            border: 1px solid lavenderblush;
        }

        tr:nth-child(even){
            background: #96ea7e;
        }

    </style>

</head>

<body>

<h2>Student Data</h2>

<table>

    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Age</th>
        <th>STD</th>
        <th>City</th>
        <th>Roll_no</th>
    </tr>

<?php

if(mysqli_num_rows($result) > 0){

    while($row = mysqli_fetch_assoc($result)){

?>

    <tr>
        <td><?php echo $row['student_id']; ?></td>
        <td><?php echo $row['student_name']; ?></td>
        <td><?php echo $row['student_age']; ?></td>
        <td><?php echo $row['student_std']; ?></td>
        <td><?php echo $row['student_city']; ?></td>
        <td><?php echo $row['student_roll_no']; ?></td>
    </tr>

<?php

    }

}else{

    echo "<tr><td colspan='6'>No Data Found</td></tr>";
}

?>

</table>

</body>
</html>
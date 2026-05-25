<?php

include 'config.php';

$query = "SELECT * FROM student";

$result = mysqli_query($conn,$query);

?>

<!DOCTYPE html>
<html>
<head>

    <title>Dashboard</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:Arial, Helvetica, sans-serif;
            background:#ececec;
            padding:20px;
        }

        h2{
            text-align:center;
            font-size:50px;
            margin-bottom:30px;
            color:#111;
        }

        .btn{
            background:linear-gradient(45deg,#6a11cb,#2575fc);
            color:white;
            padding:10px 18px;
            text-decoration:none;
            border-radius:6px;
            display:inline-block;
            transition:0.3s;
        }

        .btn:hover{
            opacity:0.9;
        }

        .delete{
            background:#d63031;
        }

        table{
            width:95%;
            margin:30px auto;
            border-collapse:collapse;
            background:white;
            border-radius:15px;
            overflow:hidden;
            box-shadow:0 5px 20px rgba(0,0,0,0.2);
        }

        th{
            background:linear-gradient(45deg,#ff416c,#ff4b2b);
            color:white;
            padding:18px;
            font-size:18px;
        }

        td{
            padding:15px;
            text-align:center;
            font-size:16px;
        }

        tr:nth-child(even){
            background:#f2f2f2;
        }

        tr:hover{
            background:#ffeaa7;
            transition:0.3s;
        }

        img{
            border-radius:10px;
        }

    </style>

</head>
<body>

<h2>Student Dashboard</h2>

<a href="student.php" class="btn">
    Add Student
</a>

<br><br>

<table>

<tr>

<?php

$fields = mysqli_fetch_fields($result);

foreach($fields as $field)
{
    echo "<th>".$field->name."</th>";
}

?>

<th>Action</th>

</tr>

<?php

while($row = mysqli_fetch_assoc($result))
{
?>

<tr>

<?php

foreach($row as $key => $value)
{
    if($key == "profile_photo")
    {
        echo "<td>
                <img src='$value' width='120'>
              </td>";
    }
    else
    {
        echo "<td>$value</td>";
    }
}

?>

<td>

    <a class='btn'
       href='edit.php?id=<?php echo $row['student_id']; ?>'>
       Edit
    </a>

    <a class='btn delete'
       href='delete.php?id=<?php echo $row['student_id']; ?>'>
       Delete
    </a>

</td>

</tr>

<?php
}
?>

</table>

</body>
</html>
<?php

include 'config.php';

$result = null;

if(isset($_GET['search'])){

    $search = $_GET['search'];

    $sql = "SELECT * FROM student
            WHERE student_name LIKE '%$search%'";

    $result = mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Search Student</title>

    <style>

        table{
    width: 95%;
    margin: 30px auto;
    border-collapse: collapse;
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 0 15px rgba(0,0,0,0.2);
}

th{
    background: linear-gradient(45deg, #ff416c, #ff4b2b);
    color: white;
    padding: 15px;
    font-size: 18px;
}

td{
    padding: 12px;
    text-align: center;
    font-size: 16px;
}

tr:nth-child(even){
    background: #f2f2f2;
}

tr:nth-child(odd){
    background: #ffffff;
}

tr:hover{
    background: #ffeaa7;
    transition: 0.3s;
}

.btn{
    background: linear-gradient(45deg, #6a11cb, #2575fc);
    color: white;
    padding: 10px 20px;
    border: none;
    text-decoration: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn:hover{
    opacity: 0.9;
}

input{
    padding: 10px;
    width: 250px;
    border-radius: 5px;
    border: 1px solid gray;
}

    </style>

</head>
<body>

    <h1>Search Student</h1>

    <form method="GET">

        <input type="text"
               name="search"
               placeholder="Enter Student Name">

        <button class="btn" type="submit">
            Search
        </button>

        <a href="index.php" class="btn">
            Back
        </a>

    </form>

    <?php

    if($result){

    ?>

    <table>

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Roll No</th>
            <th>Age</th>
            <th>City</th>
            <th>STD</th>
        </tr>

        <?php

        while($row = mysqli_fetch_assoc($result)){

        ?>

        <tr>

            <td><?php echo $row['student_id']; ?></td>

            <td><?php echo $row['student_name']; ?></td>

            <td><?php echo $row['student_roll_no']; ?></td>

            <td><?php echo $row['student_age']; ?></td>

            <td><?php echo $row['student_city']; ?></td>

            <td><?php echo $row['student_std']; ?></td>

        </tr>

        <?php
        }
        ?>

    </table>

    <?php
    }
    ?>

</body>
</html>
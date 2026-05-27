<?php

include 'config.php';

$query = "SELECT * FROM user";

$result = mysqli_query($conn,$query);

?>

<!DOCTYPE html>
<html>
<head>

    <title>User Management System</title>

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

        h1{
            text-align:center;
            margin-bottom:30px;
            font-size:45px;
            color:#111;
        }

        .top-buttons{
            margin-bottom:20px;
        }

        .btn{
            background:linear-gradient(45deg,#6a11cb,#2575fc);
            color:white;
            padding:10px 18px;
            text-decoration:none;
            border-radius:6px;
            display:inline-block;
            margin-right:10px;
            transition:0.3s;
        }

        .btn:hover{
            opacity:0.9;
        }

        .edit{
            background:#00b894;
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
            padding:15px;
            font-size:18px;
        }

        td{
            padding:12px;
            text-align:center;
            font-size:16px;
        }

        tr:nth-child(even){
            background:#f2f2f2;
        }

        tr:hover{
            background:#ffeaa7;
        }

        img{
            border-radius:10px;
        }

        .resume-link{
            text-decoration:none;
            color:#2575fc;
            font-weight:bold;
        }

    </style>

</head>
<body>

<h1>User Management System</h1>

<div class="top-buttons">

    <a href="login.php"
       class="btn">
       Add Student
    </a>

</div>

<table>

<tr>

    <th>ID</th>
    <th>Name</th>
    <th>Age</th>
    <th>City</th>
    <th>Branch</th>
    <th>Profile Photo</th>
    <th>Resume</th>
    <th>Action</th>

</tr>

<?php

while($row = mysqli_fetch_assoc($result))
{
?>

<tr>

    <td><?php echo $row['id']; ?></td>

    <td><?php echo $row['name']; ?></td>

    <td><?php echo $row['age']; ?></td>

    <td><?php echo $row['city']; ?></td>

    <td><?php echo $row['branch']; ?></td>

    <td>

        <img src="<?php echo $row['profile_photo']; ?>"
             width="100"
             height="100"
             style="object-fit:cover;">

    </td>

    <td>

        <a class="resume-link"
           href="<?php echo $row['resume_pdf']; ?>"
           target="_blank">
           View Resume
        </a>

    </td>

    <td>

        <a class="btn edit"
           href="edit.php?id=<?php echo $row['id']; ?>">
           Edit
        </a>

        <a class="btn delete"
           href="delete.php?id=<?php echo $row['id']; ?>">
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
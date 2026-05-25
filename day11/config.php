<?php

session_start();

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "school"
);

if(!$conn)
{
    die("Connection Failed");
}

?>
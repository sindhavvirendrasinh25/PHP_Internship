<?php

session_start();

include '../includes/header.php';
include '../includes/navbar.php';

?>

<h2>Class Timetable</h2>

<table border="1" cellpadding="10">

<tr>
<th>Day</th>
<th>Subject</th>
<th>Time</th>
</tr>

<tr>
<td>Monday</td>
<td>PHP</td>
<td>10:00 AM</td>
</tr>

<tr>
<td>Tuesday</td>
<td>MySQL</td>
<td>10:00 AM</td>
</tr>

<tr>
<td>Wednesday</td>
<td>JavaScript</td>
<td>10:00 AM</td>
</tr>

<tr>
<td>Thursday</td>
<td>Bootstrap</td>
<td>10:00 AM</td>
</tr>

<tr>
<td>Friday</td>
<td>Project Work</td>
<td>10:00 AM</td>
</tr>

</table>

<?php include '../includes/footer.php'; ?>
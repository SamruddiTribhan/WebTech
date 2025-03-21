<html>

<head>
    <link rel="stylesheet" href="style.css">
</head>




<?php
$conn = new mysqli("localhost", "root", "", "WT");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM students");

echo "<h2>All Mentees</h2>";
echo "<table border='1'>
    <tr><th>Roll No</th><th>Name</th><th>Email</th><th>Mobile</th><th>Address</th><th>Department</th><th>Year</th><th>GPA</th><th>Certificates</th><th>Mentor Name</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row['roll_no'] . "</td><td>" . $row['name'] . "</td><td>" . $row['email'] . "</td><td>" . $row['mobile'] . "</td><td>" . $row['address'] . "</td><td>" . $row['department'] . "</td><td>" . $row['year'] . "</td><td>" . $row['gpa'] . "</td><td>" . $row['certificates'] . "</td><td>" . $row['mentor_name'] . "</td></tr>";
}

echo "</table>";

$conn->close();
?>
<br>
<button onclick="window.location.href='index.php'">Back to Home</button>

</html>
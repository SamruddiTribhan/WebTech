<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roll_no = $_POST['roll_no'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $department = $_POST['department'];
    $year = $_POST['year'];
    $gpa = $_POST['gpa'];
    $certificates = $_POST['certificates'];
    $mentor_name = $_POST['mentor_name'];

    $conn = new mysqli("localhost", "root", "", "WT");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO students (roll_no, name, email, mobile, address, department, year, gpa, certificates, mentor_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssssss", $roll_no, $name, $email, $mobile, $address, $department, $year, $gpa, $certificates, $mentor_name);

    if ($stmt->execute()) {
        echo "Mentee added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
  <br>
  <button onclick="window.location.href='index.php'">Back to Home</button>
</body>
</html>
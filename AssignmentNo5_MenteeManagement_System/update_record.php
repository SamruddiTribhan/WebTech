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

    $stmt = $conn->prepare("UPDATE students SET name=?, email=?, mobile=?, address=?, department=?, year=?, gpa=?, certificates=?, mentor_name=? WHERE roll_no=?");
    $stmt->bind_param("sssssssssi", $name, $email, $mobile, $address, $department, $year, $gpa, $certificates, $mentor_name, $roll_no);

    if ($stmt->execute()) {
        echo "<p>Mentee updated successfully!</p>";
        echo "<a href='display.php'><button>View All Mentees</button></a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
</body>
</html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
<body>
    

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roll_no = $_POST['roll_no'];

    $conn = new mysqli("localhost", "root", "", "WT");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM students WHERE roll_no = ?");
    $stmt->bind_param("s", $roll_no);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();

    if ($student) {
        echo "<form method='post' action='update_record.php'>
            <h2>Update Mentee Details</h2>
            <label>Name:</label><input type='text' name='name' value='" . $student['name'] . "'><br><br>
            <label>Email:</label><input type='email' name='email' value='" . $student['email'] . "'><br><br>
            <label>Mobile No:</label><input type='tel' name='mobile' value='" . $student['mobile'] . "'><br><br>
            <label>Address:</label><input type='text' name='address' value='" . $student['address'] . "'><br><br>
            <label>Department:</label><input type='text' name='department' value='" . $student['department'] . "'><br><br>
            <label>Year:</label><input type='number' name='year' value='" . $student['year'] . "'><br><br>
            <label>GPA:</label><input type='text' name='gpa' value='" . $student['gpa'] . "'><br><br>
            <label>Certificates:</label><input type='text' name='certificates' value='" . $student['certificates'] . "'><br><br>
            <label>Mentor Name:</label><input type='text' name='mentor_name' value='" . $student['mentor_name'] . "'><br><br>
            <input type='hidden' name='roll_no' value='" . $student['roll_no'] . "'>
            <input type='submit' value='Update'>
        </form>";
    } else {
        echo "No record found for Roll No: $roll_no";
    }

    $stmt->close();
    $conn->close();
}
?>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentee Management System</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <script type="text/javascript">
        function validateForm() {
            let fields = ["roll_no", "name", "email", "mobile", "address", "department", "year", "gpa", "certificates", "mentor_name"];
            for (let field of fields) {
                let value = document.forms["f1"][field].value.trim();
                if (value === "") {
                    alert("Please enter " + field.replace("_", " ").toUpperCase());
                    document.forms["f1"][field].focus();
                    return false;
                }
            }
            return true;
        }
    </script>
</head>
<body>
    <h1>Mentee Management System</h1>

    <form name="f1" method="post" action="add.php" onsubmit="return validateForm()">
        <h2>Add Mentee</h2>
        <table>
            <tr><td>Roll No:</td><td><input type="number" name="roll_no"></td></tr>
            <tr><td>Name:</td><td><input type="text" name="name"></td></tr>
            <tr><td>Email:</td><td><input type="email" name="email"></td></tr>
            <tr><td>Mobile No:</td><td><input type="tel" name="mobile"></td></tr>
            <tr><td>Address:</td><td><input type="text" name="address"></td></tr>
            <tr><td>Department:</td><td><input type="text" name="department"></td></tr>
            <tr><td>Year:</td><td><input type="number" name="year"></td></tr>
            <tr><td>GPA:</td><td><input type="text" name="gpa"></td></tr>
            <tr><td>Certificates:</td><td><input type="text" name="certificates"></td></tr>
            <tr><td>Mentor Name:</td><td><input type="text" name="mentor_name"></td></tr>
        </table>
        <input type="submit" value="Add Mentee">
    </form>

    <form name="f2" method="post" action="update.php">
        <h2>Update Mentee</h2>
        <label for="roll_no_update">Enter Roll No to Update:</label>
        <input type="number" name="roll_no" id="roll_no_update">
        <input type="submit" value="Update Mentee">
    </form>

    <form name="f3" method="post" action="delete.php">
        <h2>Delete Mentee</h2>
        <label for="roll_no_delete">Enter Roll No to Delete:</label>
        <input type="number" name="roll_no" id="roll_no_delete">
        <input type="submit" value="Delete Mentee">
    </form>

    <form name="f4" method="post" action="display.php">
        <h2>Display Mentees</h2>
        <input type="submit" value="Display All Mentees">
    </form>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Mentee</title>
    <style>
       
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body and layout styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f6;
            padding: 20px;
            color: #333;
        }

        /* Container to center the content */
        .container {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            text-align: center;
        }

        /* Title styles */
        h1, h3 {
            color: #1d3557;
            font-weight: 600;
            margin-bottom: 20px;
        }

        /* Form Styling */
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            text-align: center;
        }

        /* Input fields and buttons */
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 2px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"], .back-button {
            background-color: #1d3557;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
            margin: 5px;
        }

        input[type="submit"]:hover, .back-button:hover {
            background-color: #457b9d;
        }

        /* Success message */
        .success-message {
            color: #4CAF50;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
        }

        /* Error message */
        .error-message {
            color: #e63946;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
        }

        /* Responsive Styles */
        @media only screen and (max-width: 768px) {
            body {
                padding: 10px;
            }

            .container {
                padding: 10px;
            }

            input[type="text"] {
                font-size: 14px;
            }

            input[type="submit"], .back-button {
                width: 100%;
                padding: 15px;
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Delete Mentee Record</h1>
        <form method="post">
            <input type="text" name="roll_no" placeholder="Enter Roll No" required>
            <br>
            <input type="submit" value="Delete">
        </form>

        <button class="back-button" onclick="window.location.href='index.php'">Back</button>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $roll_no = $_POST['roll_no'];

            $conn = new mysqli("localhost", "root", "", "WT");

            if ($conn->connect_error) {
                die("<div class='error-message'>Connection failed: " . $conn->connect_error . "</div>");
            }

            // Check if record exists
            $check_stmt = $conn->prepare("SELECT COUNT(*) FROM students WHERE roll_no = ?");
            $check_stmt->bind_param("s", $roll_no);
            $check_stmt->execute();
            $check_stmt->bind_result($count);
            $check_stmt->fetch();
            $check_stmt->close();

            if ($count > 0) {
                // Proceed with deletion
                $stmt = $conn->prepare("DELETE FROM students WHERE roll_no = ?");
                $stmt->bind_param("s", $roll_no);

                if ($stmt->execute()) {
                    echo "<div class='success-message'>Mentee deleted successfully!</div>";
                } else {
                    echo "<div class='error-message'>Error: " . $stmt->error . "</div>";
                }

                $stmt->close();
            } else {
                echo "<div class='error-message'>Error: No record found with Roll No: " . htmlspecialchars($roll_no) . "</div>";
            }

            $conn->close();
        }
        ?>
    </div>
</body>
</html>

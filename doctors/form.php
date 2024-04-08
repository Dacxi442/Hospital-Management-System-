<?php
// Include the navbar file
// include './layout/navbar.php';
include 'C:/wamp64/www/hospital/layout/navbar.php';
// include __DIR__ . 'navbar.php';

// Database connection details
$servername = "localhost";
$username = "root";
$password = "norah#@$&";
$database = "Jamii1_hospital";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Doctor Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h4 {
            color: #007bff;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <h4>Insert Doctor Details here</h4>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="doctorForm" onsubmit="return validateForm()">
        <label for="doc_name">Doctor's Name:</label>
        <input type="text" placeholder="Enter doctor's name" name="doc_name" id="doc_name" required>
        
        <label for="specialization">Specialization:</label>
        <input type="text" placeholder="Enter specialization" name="specialization" id="specialization" required>
        
        <label for="staff_id">Staff Name:</label>
        <select id="staff_id" name="staff_id" required>
            <?php
                // Connect to your database
                $servername = "localhost";
                $username = "root";
                $password = "norah#@$&";
                $database = "Jamii1_hospital";
                $conn = new mysqli($servername, $username, $password, $database);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch staff names
                $sql = "SELECT staff_id, name FROM Staff";
                $result = $conn->query($sql);

                // Display options
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='".$row['staff_id']."'>".$row['name']."</option>";
                    }
                }

                // Close connection
                $conn->close();
            ?>
        </select>

        <input type="submit" value="Add Doctor">
    </form>

    <script>
        function validateForm() {
            var docName = document.getElementById("doc_name").value;
            var specialization = document.getElementById("specialization").value;

            if (docName.trim() == "") {
                alert("Please enter doctor's name");
                return false;
            }

            if (specialization.trim() == "") {
                alert("Please enter specialization");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>

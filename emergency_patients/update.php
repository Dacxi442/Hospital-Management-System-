
<!DOCTYPE html>
<html>
<head>
    <title>Update Emergency Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="datetime-local"] {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Update Emergency Record</h2>

    <?php
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

    // Get the id parameter from the query string
    $id = $_GET["empatient_id"];

    // SQL query to fetch the record based on the id
    $sql = "SELECT * FROM Emergency_patients WHERE empatient_id = $id";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the record exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data
            $empatient_name = $_POST["empatient_name"];
            $contact = $_POST["contact"];
            $datetime_added = $_POST["datetime_added"];

            // Prepare SQL statement
            $sql = "UPDATE Emergency_patients SET empatient_name = ?, contact = ?, datetime_added = ? WHERE empatient_id = ?";

            // Prepare statement
            $stmt = $conn->prepare($sql);

            // Bind parameters
            $stmt->bind_param("sssi", $empatient_name, $contact, $datetime_added, $id);

            // Execute statement
            if ($stmt->execute()) {
                header("Location: table.php?success=true");
                echo "Record updated successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            // Close statement
            $stmt->close();
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?empatient_id=" . $id; ?>">
            <label for="empatient_name">Name:</label>
            <input type="text" id="empatient_name" name="empatient_name" value="<?php echo $row["empatient_name"]; ?>" required><br>
            <label for="contact">Contact:</label>
            <input type="text" id="contact" name="contact" value="<?php echo $row["contact"]; ?>" required><br>
            <label for="datetime_added">Date Admitted:</label>
            <input type="datetime-local" id="datetime_added" name="datetime_added" value="<?php echo $row["datetime_added"]; ?>" required><br>
            <input type="submit" name="submit" value="Update">
        </form>
        <?php
    } else {
        echo "No record found.";
    }

    // Close the connection
    $conn->close();
    ?>
</body>
</html>

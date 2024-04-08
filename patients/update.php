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
$id = $_GET["patient_id"] ?? null;

// Check if the id is provided
if ($id === null) {
    die("No patient ID provided.");
}

// SQL query to fetch the record based on the id
$sql = "SELECT * FROM patients WHERE patient_id = $id";

// Execute the query
$result = $conn->query($sql);

// Check if the record exists
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $name = $_POST["name"] ?? "";
        $address = $_POST["address"] ?? "";
        $contact = $_POST["contact"] ?? "";
        $datetime_added = $_POST["datetime_added"] ?? "";

        // Prepare SQL statement
        $sql = "UPDATE patients SET patient_name = ?, address = ?, contact = ?, datetime_added = ? WHERE patient_id = ?";

        // Prepare statement
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bind_param("ssssi", $name, $address, $contact, $datetime_added, $id);

        // Execute statement
        if ($stmt->execute()) {
            header("Location: table.php?success=true");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Update Patient Record</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f2f2f2;
                padding: 20px;
            }
            .container {
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            h2 {
                color: #333;
            }
            form {
                margin-top: 20px;
            }
            label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
                color: #555;
            }
            input[type="text"],
            textarea,
            input[type="datetime-local"] {
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 4px;
                box-sizing: border-box;
                margin-bottom: 15px;
            }
            input[type="submit"] {
                display: inline-block;
                padding: 8px 16px;
                background-color: #4CAF50;
                color: #fff;
                text-decoration: none;
                border-radius: 4px;
                transition: background-color 0.3s;
                border: none;
                cursor: pointer;
            }
            input[type="submit"]:hover {
                background-color: #3e8e41;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Update Patient Record</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?patient_id=" . $id; ?>">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row["patient_name"]); ?>" required><br><br>
                <label for="address">Address:</label>
                <textarea id="address" name="address" required><?php echo htmlspecialchars($row["address"]); ?></textarea><br><br>
                <label for="contact">Contact:</label>
                <input type="text" id="contact" name="contact" value="<?php echo htmlspecialchars($row["contact"]); ?>" required><br><br>
                <label for="datetime_added">Date Admitted:</label>
                <input type="datetime-local" id="datetime_added" name="datetime_added" value="<?php echo htmlspecialchars($row["datetime_added"]); ?>" required><br><br>
                <input type="submit" name="submit" value="Update">
            </form>
        </div>
    </body>
    </html>
    <?php
} else {
    echo "No record found.";
}

// Close the connection
$conn->close();
?>

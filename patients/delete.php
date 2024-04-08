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
$patient_id = $_GET["patient_id"];

// First, delete related appointments
$sql_delete_appointments = "DELETE FROM appointments WHERE patient_id = $patient_id";

if ($conn->query($sql_delete_appointments) === FALSE) {
    // Redirect to the table page with an error message
    header("Location: table.php?error=" . urlencode("Error deleting related appointments: " . $conn->error));
    exit();
}

// SQL query to delete the record
$sql_delete_patient = "DELETE FROM Patients WHERE patient_id = $patient_id";

// Execute the query
if ($conn->query($sql_delete_patient) === TRUE) {
    // Redirect to the table page with a success message
    header("Location: table.php?success=true");
    exit();
} else {
    // Redirect to the table page with an error message
    header("Location: table.php?error=" . urlencode("Error deleting record: " . $conn->error));
    exit();
}

// Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Patient Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            padding: 20px;
            text-align: center;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }
        h2 {
            color: #333;
        }
        p {
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Delete Patient Record</h2>
        <p>The patient record has been deleted successfully.</p>
    </div>
</body>
</html>

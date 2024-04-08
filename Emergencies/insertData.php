<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "norah#@$&"; // It's better to store this securely
$database = "Jamii1_hospital";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $emergency_type = $_POST['emergency_type'];
    $emergency_details = $_POST['emergency_details'];
    $emergency_date = $_POST['emergency_date'];
    $empatient_id = $_POST['empatient_id'];
    $staff_id = $_POST['staff_id'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO Emergencies(emergency_type, emergency_details, emergency_date, empatient_id, staff_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssii", $emergency_type, $emergency_details, $emergency_date, $empatient_id, $staff_id);

    // Execute the prepared statement
    if ($stmt->execute()) {
        header("Location: table.php?success=true");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
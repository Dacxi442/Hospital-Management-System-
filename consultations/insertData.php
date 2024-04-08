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

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $consultation_date = $_POST['consultation_date'];
    $notes = $_POST['notes'];
    $patient_id = $_POST['patient_id'];
    $staff_id = $_POST['staff_id'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO Consultations(consultation_date, notes, patient_id, staff_id) 
    VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $consultation_date, $notes, $patient_id, $staff_id);

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
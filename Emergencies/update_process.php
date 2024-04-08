<?php
include 'C:\wamp64\www\hospital\layout\navbar.php'; 


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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $emergency_type = $_POST['emergency_type'];
    $emergency_details = $_POST['emergency_details'];
    $emergency_date = $_POST['emergency_date'];
    $empatient_id = $_POST['empatient_id'];
    $staff_id = $_POST['staff_id'];
    $emergency_id = $_POST['emergency_id'];

    // Prepare SQL statement
    $sql = "UPDATE Emergencies SET emergency_type = ?, emergency_details = ?, emergency_date = ?, 
    empatient_id = ?, staff_id = ? WHERE emergency_id = ?";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("sssiii", $emergency_type, $emergency_details, $emergency_date, $empatient_id, $staff_id,
                      $emergency_id);

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

// Close connection
$conn->close();
?>
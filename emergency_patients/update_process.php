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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST["empatient_id"];
    $name = $_POST["empatient_name"];
    $contact = $_POST["contact"];
    $datetime_added = $_POST["datetime_added"];

    // Prepare SQL statement
    $sql = "UPDATE patients SET empatient_name = ?, contact = ?, datetime_added = ? WHERE id = ?";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("sssi", $empatient_name ,$contact, $datetime_added, $id);

    // Execute statement
    if ($stmt->execute()) {
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
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
    $id = $_POST["patient_id"];
    $name = $_POST["patient_name"];
    $address = $_POST["address"];
    $contact = $_POST["contact"];
    $date_admitted = $_POST["datetime_admitted"];

    // Prepare SQL statement
    $sql = "UPDATE patients SET patient_name = ?, address = ?, contact = ?, datetime_data = ? WHERE id = ?";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ssssi", $name, $address, $contact, $date_admitted, $id);

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
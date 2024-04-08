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
    $doc_name = $_POST['doc_name'];
    $specialization = $_POST['specialization'];
    $staff_id = $_POST['staff_id'];

    // Assuming patient_id is not provided in the form and can be NULL
    // If patient_id is also provided, ensure to retrieve it from $_POST['patient_id']
    $patient_id = null;

    $stmt = $conn->prepare("INSERT INTO Doctors (doc_name, specialization, patient_id, staff_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $doc_name, $specialization, $patient_id, $staff_id);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Close connection
$conn->close();
?>

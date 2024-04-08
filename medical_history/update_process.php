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
    $patient_diagnosis = $_POST['patient_diagnosis'];
    $medication = $_POST['medication'];
    $diagnosis_date = $_POST['diagnosis_date'];
    $notes = $_POST['notes'];
    $patient_id = $_POST['patient_id'];
    $staff_id = $_POST['staff_id'];
    $history_id = $_POST['history_id'];

    // Prepare SQL statement
    $sql = "UPDATE patient_medical_history SET Patient_diagnosis = ?, medication = ?, diagnosis_date = ?, notes = ?, 
    patient_id = ?, staff_id = ? WHERE history_id = ?";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ssssiii", $patient_diagnosis, $medication, $diagnosis_date, $notes, $patient_id, $staff_id,
                      $history_id);

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
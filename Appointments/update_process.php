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
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $appointment_reason = $_POST['appointment_reason'];
    $patient_id = $_POST['patient_id'];
    $staff_id = $_POST['staff_id'];
    $appointment_id = $_POST['appointment_id'];

    // Prepare a SQL statement to check if the patient_id and staff_id exist
    $checkSql = "SELECT 
                    (SELECT COUNT(*) FROM Patients WHERE patient_id = ?) AS patient_count,
                    (SELECT COUNT(*) FROM staff WHERE staff_id = ?) AS staff_count";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("ii", $patient_id, $staff_id);
    $checkStmt->execute();
    $checkStmt->bind_result($patientCount, $staffCount);
    $checkStmt->fetch();
    $checkStmt->close();

    // If the patient_id or staff_id doesn't exist, handle the error or redirect
    if ($patientCount == 0 || $staffCount == 0) {
        $error = "Invalid patient_id or staff_id provided.";
        header("Location: table.php?error=" . urlencode($error));
        exit();
    }

    // Prepare SQL statement
    $sql = "UPDATE Appointments SET appointment_date = ?, appointment_time = ?, appointment_reason = ?, patient_id = ?, staff_id = ? WHERE appointment_id = ?";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("sssiis", $appointment_date, $appointment_time, $appointment_reason, $patient_id, $staff_id, $appointment_id);

    // Execute statement
    if ($stmt->execute()) {
        header("Location: table.php?success=true");
    } else {
        $error = "Error updating record: " . $conn->error;
        header("Location: table.php?error=" . urlencode($error));
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
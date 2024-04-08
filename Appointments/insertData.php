<?php
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

// Set character encoding for the connection
$conn->set_charset("utf8mb4");
mysqli_set_charset($conn, "utf8mb4");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $staff_id = $_POST['staff_id'];
    $appointment_reason = $_POST['appointment_reason'];
    $patient_id = $_POST['patient_id'];

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO Appointments (appointment_date, appointment_time, staff_id, appointment_reason, patient_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $appointment_date, $appointment_time, $staff_id, $appointment_reason, $patient_id);

    if ($stmt->execute()) {
        header("Location: table.php?success=true");
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>
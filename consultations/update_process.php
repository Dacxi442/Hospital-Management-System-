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
    $consultation_date = $_POST['consultation_date'];
    $notes = $_POST['notes'];
    $patient_id = $_POST['patient_id'];
    $staff_id = $_POST['staff_id'];
    $consultation_id = $_POST['consultation_id'];


    // Prepare SQL statement
    $sql = "UPDATE Consultations SET consultation_date = ?, notes = ?, 
    patient_id = ?, staff_id = ? WHERE consultation_id = ?";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ssiii",$consultation_date, $notes,  $patient_id, $staff_id,
                      $consultation_id);

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
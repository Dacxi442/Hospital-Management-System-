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
    $doc_name = $_POST['doc_name'];
    $specialization = $_POST['specialization'];
    $patient_id = $_POST['patient_id'];
    $staff_id = $_POST['staff_id'];
    $doc_id = $_POST['doc_id'];

    // Prepare SQL statement
    $sql = "UPDATE Doctors SET doc_name = ?, specialization = ?, 
    patient_id = ?, staff_id = ? WHERE doc_id = ?";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ssiii", $doc_name, $specialization, $patient_id, $staff_id,
                      $doc_id);

    // Execute statement
    if ($stmt->execute()) {
        echo "Record updated successfully.";
        header("Location: table.php?success=true");
        // echo "Record updated successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
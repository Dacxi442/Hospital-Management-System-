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
    $med_name = $_POST['med_name'];
    $dosage_form = $_POST['dosage_form'];
    $med_id = $_POST['med_id'];
    

    // Prepare SQL statement
    $sql = "UPDATE Medications SET med_name = ?, dosage_form = ? WHERE med_id = ?";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ssii", $med_name, $dosage_form, $med_id);

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
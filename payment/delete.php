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

// Check if id is set
if (isset($_GET['payment_id'])) {
    $delete_id = $_GET['payment_id'];
    
    // Delete record from patient_medical_history table
    $sql_delete = "DELETE FROM Payments WHERE payment_id = '$delete_id'";
    if ($conn->query($sql_delete) === TRUE) {
        header("Location: table.php?success=true");
        // echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>

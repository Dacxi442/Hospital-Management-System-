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

// Get the id parameter from the query string
$id = $_GET["empatient_id"];

// SQL query to delete the record
$sql = "DELETE FROM Emergency_patients WHERE empatient_id = $id";

// Execute the query
if ($conn->query($sql) === TRUE) {
    header("Location: table.php?success=true");
        exit();
} else {
    header("Location: table.php?success=true");
    echo "Error deleting record: " . $conn->error;
}

// Close the connection
$conn->close();
?>
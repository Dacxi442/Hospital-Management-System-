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
$id = $_GET["membership_id"];

// SQL query to delete the record
$sql = "DELETE FROM patient_membership WHERE membership_id = $id";

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
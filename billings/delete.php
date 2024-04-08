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
if (isset($_GET['bill_id'])) {
    $delete_id = $_GET['bill_id'];

    // Delete related records from Payments table
    $sql_delete_payments = "DELETE FROM Payments WHERE bill_id = '$delete_id'";
    if ($conn->query($sql_delete_payments) === TRUE) {
        // Delete record from Billings table
        $sql_delete_billings = "DELETE FROM Billings WHERE bill_id = '$delete_id'";
        if ($conn->query($sql_delete_billings) === TRUE) {
            header("Location: table.php?success=true");
        } else {
            echo "Error deleting record from Billings table: " . $conn->error;
        }
    } else {
        echo "Error deleting records from Payments table: " . $conn->error;
    }
}

$conn->close();
?>
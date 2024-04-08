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
    $payment_date = $_POST["payment_date"];
    $amount = $_POST["amount"];
    $payment_method = $_POST["payment_method"];
    $bill_id = $_POST["bill_id"];
    $patient_id = $_POST["patient_id"];
    $payment_id = $_POST["payment_id"];

    // Prepare SQL statement
    $sql = "UPDATE Payments SET payment_date = ?, amount = ?, payment_method = ?, bill_id = ? , patient_id = ? WHERE payment_id = ?";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("sssiii", $payment_date, $amount, $payment_method, $bill_id, $patient_id, $payment_id);

    // Execute statement
    if ($stmt->execute()) {
        echo "Record updated successfully.";
        header("Location: table.php?success=true");

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
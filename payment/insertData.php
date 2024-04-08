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

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $payment_date = $_POST['payment_date'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];
    $bill_id = $_POST['bill_id'];
    $patient_id = $_POST['patient_id'];

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO Payments (payment_date, amount, payment_method, bill_id, patient_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $payment_date, $amount, $payment_method, $bill_id, $patient_id);

    if ($stmt->execute()) {
        header("Location: table.php?success=true");
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
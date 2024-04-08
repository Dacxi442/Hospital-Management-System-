<?php
// Include the navbar file
include 'C:/wamp64/www/hospital/layout/navbar.php';

// Connect to your database (assuming you're using MySQL)
$servername = "localhost";
$username = "root";
$password = "norah#@$&";
$database = "Jamii1_hospital";
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $membership_id = $_POST['membership_id'];
    $membership_type = $_POST['membership_type'];
    $membership_start_date = $_POST['membership_start_date'];
    $membership_end_date = $_POST['membership_end_date'];
    $membership_fee = $_POST['membership_fee'];
    $membership_benefits = $_POST['membership_benefits'];
    $patient_id = $_POST['patient_id'];

    // Prepare SQL statement
    $sql = "UPDATE patient_membership
            SET membership_type = ?,
                membership_start_date = ?,
                membership_end_date = ?,
                membership_fee = ?,
                membership_benefits = ?,
                patient_id = ?
            WHERE membership_id = ?";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("sssssii", $membership_type, $membership_start_date, $membership_end_date, $membership_fee, $membership_benefits, $patient_id, $membership_id);

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
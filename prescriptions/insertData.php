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
    $medication_detail = $_POST['medication_detail'];
    $prescription_date = $_POST['prescription_date'];
    $patient_id = $_POST['patient_id'];
    $med_id = $_POST['med_id'];
    $staff_id = $_POST['staff_id'];

    // Insert data into prescriptions table
    $sql = "INSERT INTO Prescriptions (medication_detail, prescription_date, patient_id, med_id, staff_id) 
    VALUES ('$medication_detail', '$prescription_date', '$patient_id', '$med_id', '$staff_id')";

    if ($conn->query($sql) === TRUE) {
        header("Location: table.php?success=true");

        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

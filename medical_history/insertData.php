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
    $patient_diagnosis = $_POST['patient_diagnosis'];
    $medication = $_POST['medication'];
    $diagnosis_date = $_POST['diagnosis_date'];
    $notes = $_POST['notes'];
    $patient_id = $_POST['patient_id'];
    $staff_id = $_POST['staff_id'];

    // Insert data into Staff table
    $sql = "INSERT INTO patient_medical_history (patient_diagnosis, medication, diagnosis_date, notes, patient_id, staff_id)
     VALUES ('$patient_diagnosis', '$medication', '$diagnosis_date', '$notes', '$patient_id','$staff_id')";

    if ($conn->query($sql) === TRUE) {
        header("Location: table.php?success=true");

        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

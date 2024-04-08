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
    $total_amount = $_POST['total_amount'];
    
    $patient_id = $_POST['patient_id'];

    // Sanitize and validate input data
    $total_amount = $conn->real_escape_string($total_amount);
    $patient_id = $conn->real_escape_string($patient_id);
   
    // Check if the ward_id exists in the wards table
    $check_ward_query = "SELECT patient_id FROM Patients WHERE patient_id = '$patient_id'";
    $check_ward_result = $conn->query($check_ward_query);

    if ($check_ward_result->num_rows > 0) {
        // Insert data into billings table
        $sql = "INSERT INTO Billings (total_amount, patient_id) VALUES ('$total_amount','$patient_id')";

        if ($conn->query($sql) === TRUE) {
            header("Location: table.php?success=true");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Invalid ward_id";
    }
}

$conn->close();
?>
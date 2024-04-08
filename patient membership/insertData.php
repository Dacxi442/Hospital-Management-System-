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
    $membership_type = $_POST['membership_type'];
    $membership_start_date = $_POST['membership_start_date'];
    $membership_end_date = $_POST['membership_end_date'];
    $membership_fee = $_POST['membership_fee'];
    $membership_benefits = $_POST['membership_benefits'];
    $patient_id = $_POST['patient_id'];

    // Sanitize and validate input data
    $membership_type = $conn->real_escape_string($membership_type);
    $membership_start_date = $conn->real_escape_string($membership_start_date);
    $membership_end_date = $conn->real_escape_string($membership_end_date);
    $membership_fee = $conn->real_escape_string($membership_fee);
    $membership_benefits = $conn->real_escape_string($membership_benefits);
    $patient_id = $conn->real_escape_string($patient_id);

    // Check if the patient_id exists in the Patients table
    $check_patient_query = "SELECT patient_id FROM Patients WHERE patient_id = '$patient_id'";
    $check_patient_result = $conn->query($check_patient_query);

    if ($check_patient_result->num_rows > 0) {
        // Insert data into patient_membership table
        $sql = "INSERT INTO patient_membership (membership_type, membership_start_date, membership_end_date, membership_fee, membership_benefits, patient_id)
                VALUES ('$membership_type', '$membership_start_date', '$membership_end_date', '$membership_fee', '$membership_benefits', '$patient_id')";

        if ($conn->query($sql) === TRUE) {
            header("Location: table.php?success=true");
           // echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Invalid patient_id";
    }
}

$conn->close();
?>
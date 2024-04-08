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
    $bed_number = $_POST['bed_number'];
    $status = $_POST['status'];
    $ward_id = $_POST['ward_id'];

    // Sanitize and validate input data
    $bed_number = $conn->real_escape_string($bed_number);
    $status = $conn->real_escape_string($status);
    $ward_id = $conn->real_escape_string($ward_id);

    // Check if the ward_id exists in the wards table
    $check_ward_query = "SELECT ward_id FROM wards WHERE ward_id = '$ward_id'";
    $check_ward_result = $conn->query($check_ward_query);

    if ($check_ward_result->num_rows > 0) {
        // Insert data into Beds table
        $sql = "INSERT INTO Beds (bed_number, status, ward_id) VALUES ('$bed_number', '$status', '$ward_id')";

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
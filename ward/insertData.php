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
    $ward_name = $_POST['ward_name'];
    $ward_type = $_POST['ward_type'];
   

    // Insert data into Staff table
    $sql = "INSERT INTO Wards (ward_name, ward_type) VALUES ('$ward_name', '$ward_type')";

    if ($conn->query($sql) === TRUE) {
        header("Location: table.php?success=true");

        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

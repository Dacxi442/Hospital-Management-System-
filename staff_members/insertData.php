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
    $name = $_POST['name'];
    $role = $_POST['role'];
    $dept_id = $_POST['dept_id'];
    $contact = $_POST['contact'];
    $specialization = $_POST['specialization'];

    // Insert data into Staff table
    $sql = "INSERT INTO Staff (name, role, dept_id, contact, specialization) VALUES ('$name', '$role', '$dept_id', '$contact', '$specialization')";

    if ($conn->query($sql) === TRUE) {
        header("Location: table.php?success=true");

        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $Department_name = $_POST["Department_name"];
    $Description_name = $_POST["Description_name"];
    $Department_type = $_POST["Department_type"];
    

    // Prepare SQL statement
    $sql = "INSERT INTO Departments (dept_name,description,department_type) VALUES (?, ?, ?)";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("sss", $Department_name, $Description_name, $Department_type);

    // Execute statement
    if ($stmt->execute()) {
        header("Location: table.php?success=true");
        echo "Data inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
<?php
// Connect to your database (assuming you're using MySQL)
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

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $bed_id = $_POST["bed_id"];
    $bed_number = $_POST["bed_number"];
    $status = $_POST["status"];
    $ward_id = $_POST["ward_id"];

    // Prepare SQL statement
    $sql = "UPDATE Beds SET bed_number=?, status=?, ward_id=? WHERE bed_id=?";
    $stmt = $conn->prepare($sql);

    // Bind parameters (corrected order)
    $stmt->bind_param("ssii", $bed_number, $status, $ward_id, $bed_id);

    // Execute statement
    if ($stmt->execute()) {
        // Redirect to table.php with success parameter
        header("Location: table.php?success=true");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>
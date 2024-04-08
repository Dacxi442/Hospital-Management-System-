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
    // Check if all required fields are set
    // if (isset($_POST["staff_id"], $_POST["name"], $_POST["role"], $_POST["dept_id"], $_POST["contact"], $_POST["specialization"])) {
        // Retrieve form data
        $staff_id = $_POST["staff_id"];
        $name = $_POST["name"];
        $role = $_POST["role"];
        $dept_id = $_POST["dept_id"];
        $contact = $_POST["contact"];
        $specialization = $_POST["specialization"];

        // Prepare SQL statement
        $sql = "UPDATE Staff SET name=?, role=?, contact=?, specialization=?, dept_id=? WHERE staff_id=?";
        $stmt = $conn->prepare($sql);

        // Bind parameters (corrected order)
        $stmt->bind_param("ssissi", $name, $role, $contact, $specialization, $dept_id, $staff_id);

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
    } else {
        echo "Some required fields are missing.";
    }
// }

// Close database connection
$conn->close();
?>

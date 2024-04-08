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
    if (isset($_POST["medication_detail"]) && isset($_POST["prescription_date"]) && isset($_POST["patient_id"]) && isset($_POST["med_id"]) && isset($_POST["staff_id"]) && isset($_POST["pres_id"])) {
        // Retrieve form data
        $medication_detail = $_POST["medication_detail"];
        $prescription_date = $_POST["prescription_date"];
        $patient_id = $_POST["patient_id"];
        $med_id = $_POST["med_id"];
        $staff_id = $_POST["staff_id"];
        $pres_id = $_POST['pres_id'];

        // Prepare SQL statement
        $sql = "UPDATE Prescriptions SET medication_detail=?, prescription_date=?, patient_id=?, med_id=?, staff_id=? WHERE pres_id=?";
        $stmt = $conn->prepare($sql);

        // Bind parameters (corrected order)
        $stmt->bind_param("ssiiis", $medication_detail, $prescription_date, $patient_id, $med_id, $staff_id, $pres_id);

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
}

// Close database connection
$conn->close();
?>
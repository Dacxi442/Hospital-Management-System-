

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
    // if (isset($_POST["total_amount"]) && isset($_POST["patient_id"]) && isset($_POST["bill_id"]) ) {
        // Retrieve form data
    $total_amount = $_POST["total_amount"];
    $patient_id = $_POST["patient_id"];
    $bill_id = $_POST['bill_id'];
   

        // Prepare SQL statement
        $sql = "UPDATE Billings SET total_amount=?, patient_id=? WHERE bill_id=?";
        $stmt = $conn->prepare($sql);

        // Bind parameters (corrected order)
        $stmt->bind_param("sii", $total_amount,  $patient_id, $bill_id);

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


// Close database connection
$conn->close();
?>
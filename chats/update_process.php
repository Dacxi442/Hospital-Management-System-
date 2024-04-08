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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $chat_start_time = $_POST['chat_start_time'];
    $chat_end_time = $_POST['chat_end_time'];
    $consultation_id = $_POST['consultation_id'];
    $chat_id = $_POST['chat_id'];

    // Convert datetime strings to MySQL datetime format
    $chat_start_time = date('Y-m-d H:i:s', strtotime($chat_start_time));
    $chat_end_time = date('Y-m-d H:i:s', strtotime($chat_end_time));

    // Prepare SQL statement
    $sql = "UPDATE Consultation_Chats SET chat_start_time = ?, chat_end_time = ?, consultation_id = ? WHERE chat_id = ?";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ssii", $chat_start_time, $chat_end_time, $consultation_id, $chat_id);

    // Execute statement
    if ($stmt->execute()) {
        header("Location: table.php?success=true");
        echo "Record updated successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
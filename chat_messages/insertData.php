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
    $chat_id = $_POST['chat_id'];
    $sender = $_POST['sender'];
    $message_text = $_POST['message_text'];
    $timestamp = date('Y-m-d H:i:s'); // Get current timestamp

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO Chat_Messages(chat_id, sender, message_text, timestamp) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $chat_id, $sender, $message_text, $timestamp);

    // Execute the prepared statement
    if ($stmt->execute()) {
        header("Location: table.php?success=true");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
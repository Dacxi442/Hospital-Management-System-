
<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "norah#@$&"; // It's better to store this securely
$database = "Jamii1_hospital";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $chat_start_time = mysqli_real_escape_string($conn, $_POST['chat_start_time']);
    $chat_end_time = mysqli_real_escape_string($conn, $_POST['chat_end_time']);
    $consultation_id = (int) $_POST['consultation_id']; // Cast to integer

    // Convert datetime strings to MySQL datetime format
    $chat_start_time = date('Y-m-d H:i:s', strtotime($chat_start_time));
    $chat_end_time = date('Y-m-d H:i:s', strtotime($chat_end_time));

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO Consultation_Chats(chat_start_time, chat_end_time, consultation_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $chat_start_time, $chat_end_time, $consultation_id);

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
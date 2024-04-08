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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Chat Message</title>
</head>
<body>
    <h2>Add Chat Message</h2>
    <form method="post" action="insertData.php">
        Chat ID:
        <select name="chat_id" required>
            <?php
            $sql = "SELECT chat_id FROM Consultation_Chats";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['chat_id'] . "'>" . $row['chat_id'] . "</option>";
                }
            } else {
                echo "<option value=''>No chats available</option>";
            }
            ?>
        </select><br>

        Sender:
        <input type="text" name="sender" required><br>

        Message Text:
        <textarea name="message_text" required></textarea><br>

        <input type="submit" name="submit" value="Add Message">
    </form>
</body>
</html>

<?php
$conn->close();
?>
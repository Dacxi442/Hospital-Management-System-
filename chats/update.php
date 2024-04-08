<?php
// Include the navbar file
include 'C:/wamp64/www/hospital/layout/navbar.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Consultation Chat</title>
</head>
<body>
    <h2>Update Consultation Chat</h2>
    <?php
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

    // Fetch data from the Consultation_Chats table based on the chat_id
    if (isset($_GET['chat_id'])) {
        $id = $_GET['chat_id'];
        $sql = "SELECT * FROM Consultation_Chats WHERE chat_id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <form method="post" action="update_process.php">
                <input type="hidden" name="chat_id" value="<?php echo $row['chat_id']; ?>">

                Chat Start Time:
                <input type="datetime-local" name="chat_start_time" value="<?php echo $row['chat_start_time']; ?>" required>

                Chat End Time:
                <input type="datetime-local" name="chat_end_time" value="<?php echo $row['chat_end_time']; ?>" required>

                Consultation ID:
                <select id="consultation_id" name="consultation_id" required>
                    <?php
                    // Connect to your database (no need for a new connection)

                    // Fetch consultations
                    $sql = "SELECT consultation_id FROM Consultations";
                    $result = $conn->query($sql);

                    // Display options
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='".$row['consultation_id']."'>".$row['consultation_id']."</option>";
                        }
                    }

                    // Close the consultation result set
                    $result->close();
                    ?>
                </select><br>

                <input type="submit" name="update" value="Update Chat">
            </form>
            <?php
        } else {
            echo "Record not found.";
        }
    } else {
        echo "Chat ID not provided.";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
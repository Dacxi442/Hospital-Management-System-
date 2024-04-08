<!DOCTYPE html>
<html>
<head>
    <title>Chat Messages</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f0f0f0;
        }

        th {
            background-color: #f2f2f2;
        }

        td {
            vertical-align: top;
        }
    </style>
</head>
<body>
    <h2>Chat Messages</h2>
    <table>
        <tr>
            <th>Message ID</th>
            <th>Chat ID</th>
            <th>Sender</th>
            <th>Message Text</th>
            <th>Timestamp</th>
        </tr>
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

        // SQL query to retrieve chat messages
        $sql = "SELECT * FROM Chat_Messages";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['message_id'] . "</td>
                        <td>" . $row['chat_id'] . "</td>
                        <td>" . $row['sender'] . "</td>
                        <td>" . $row['message_text'] . "</td>
                        <td>" . $row['timestamp'] . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No messages found</td></tr>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </table>
</body>
</html>

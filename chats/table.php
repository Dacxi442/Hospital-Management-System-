
<!DOCTYPE html>
<html>
<head>
    <title>Chat Details</title>
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

        h4 {
            margin-bottom: 10px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            text-align: left;
        }

        td {
            vertical-align: top;
        }

        .action-links a {
            margin-right: 5px;
        }

        .action-links a.delete {
            color: #dc3545;
        }

        .action-links a.delete:hover {
            color: #bf2d38;
        }
    </style>
</head>
<body>
   
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

// SQL query to retrieve chat details
$sql = "SELECT cc.chat_id, cc.chat_start_time, cc.chat_end_time, c.consultation_id
FROM Consultation_Chats cc
JOIN Consultations c ON cc.consultation_id = c.consultation_id";

$result = $conn->query($sql);

?>
    <h2>Chat Details</h2>
    <h4><a href="form.php">Add Chat Details</a></h4>

    <table>
        <tr>
            <th>Chat Start Time</th>
            <th>Chat End Time</th>
            <th>Action</th>
        </tr>
        <?php if ($result->num_rows > 0) { ?>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row["chat_start_time"]; ?></td>
                    <td><?php echo $row["chat_end_time"]; ?></td>
                    <td class="action-links">
                        <a href="update.php?chat_id=<?php echo $row["chat_id"]; ?>">Update</a>
                        <a href="delete.php?chat_id=<?php echo $row["chat_id"]; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr><td colspan="3">No records found</td></tr>
        <?php } ?>
    </table>
</body>
</html>

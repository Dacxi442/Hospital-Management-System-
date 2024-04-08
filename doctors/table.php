<?php
// Include the navbar file
// include './layout/navbar.php';
include 'C:/wamp64/www/hospital/layout/navbar.php';
// include __DIR__ . 'navbar.php';
?>
<?php
// Connect to your database (assuming you're using MySQL)
$servername = "localhost";
                $username = "root";
                $password = "norah#@$&";
                $database = "Jamii1_hospital";
                $conn = new mysqli($servername, $username, $password, $database);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }


// Fetch data from Staff table joining with doctors table
$sql = "SELECT d.doc_id, d.doc_name, d.specialization, s.name AS staff_name
        FROM Doctors d
        INNER JOIN Staff s ON d.staff_id = s.staff_id";

$result = $conn->query($sql);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #007bff;
        }

        h4 {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .action-links a {
            margin-right: 5px;
            color: #007bff;
            text-decoration: none;
        }

        .action-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Doctor Details</h2>
    <h4><a href="form.php" class="add-button">Add Doctor Details</a></h4>
    <table>
        <tr>
            <th>Doctor Name</th>
            <th>Specialization</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row["doc_name"]?></td>
                    <td><?php echo $row["specialization"]?></td>
                    <td class="action-links">
                        <a href="update.php?doc_id=<?php echo $row["doc_id"]; ?>">Update</a>
                        <a href="delete.php?doc_id=<?php echo $row["doc_id"]; ?>" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr><td colspan='3'>No records found</td></tr>
            <?php
        }
        ?>
    </table>
</body>
</html>

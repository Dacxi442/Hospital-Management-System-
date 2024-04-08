<?php
// Include the navbar file
// include './layout/navbar.php';
include 'C:/wamp64/www/hospital/layout/navbar.php';
// include __DIR__ . 'navbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Billing Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #007bff;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="text"], select {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Update Billing Record</h2>
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

    if (isset($_GET['bill_id'])) {
        $id = $_GET['bill_id'];
        $sql = "SELECT b.bill_id, b.total_amount, p.patient_name, p.patient_id
                FROM Billings b
                INNER JOIN Patients p ON b.patient_id = p.patient_id
                WHERE b.bill_id = $id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <form method="post" action="update_process.php">
                <input type="hidden" name="bill_id" value="<?php echo $row['bill_id']; ?>">
                Total Amount: <input type="text" name="total_amount" value="<?php echo $row['total_amount']; ?>"><br><br>
              
                Patient Name:
                <select id="patient_id" name="patient_id" required>
                    <?php
                    // Fetch patient names
                    $sql_patients = "SELECT patient_id, patient_name FROM Patients";
                    $result_patients = $conn->query($sql_patients);

                    if ($result_patients->num_rows > 0) {
                        while ($row_patient = $result_patients->fetch_assoc()) {
                            $selected = ($row_patient['patient_id'] == $row['patient_id']) ? 'selected' : '';
                            echo "<option value='" . $row_patient['patient_id'] . "' $selected>" . $row_patient['patient_name'] . "</option>";
                        }
                    }
                    ?>
                </select><br>

                <input type="submit" name="update" value="Update Bill">
            </form>
            <?php
        } else {
            echo "Record not found.";
        }
    } else {
        echo "Billing ID not provided.";
    }

    $conn->close();
    ?>
</body>
</html>

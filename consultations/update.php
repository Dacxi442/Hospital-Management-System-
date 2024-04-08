<!DOCTYPE html>
<html>
<head>
    <title>Update Consultations</title>
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

        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #fff;
            color: #333;
            appearance: none;
        }
    </style>
</head>
<body>
<?php
// Include the navbar file

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

// Fetch data from the Consultations table based on the consultation_id
if (isset($_GET['consultation_id'])) {
    $id = $_GET['consultation_id'];
    $sql = "SELECT e.consultation_id, e.consultation_date, e.notes, p.patient_name, f.name
    FROM Consultations e
    JOIN Patients p ON p.patient_id = e.patient_id
    JOIN Staff f ON e.staff_id = f.staff_id
    WHERE e.consultation_id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <h2>Update Consultation</h2>
        <form method="post" action="update_process.php">
            <input type="hidden" name="consultation_id" value="<?php echo $row['consultation_id']; ?>">

            <label for="consultation_date">Consultation Date:</label>
            <input type="date" id="consultation_date" name="consultation_date" value="<?php echo $row['consultation_date']; ?>" required>
<br>
            <label for="notes">Notes:</label>
            <input type="text" id="notes" name="notes" value="<?php echo $row['notes']; ?>" required>

            <label for="patient_id">Patient Name:</label>
            <select id="patient_id" name="patient_id" required>
                <?php
                // Fetch patient names
                $sql = "SELECT patient_id, patient_name FROM Patients";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($patient_row = $result->fetch_assoc()) {
                        $selected = ($patient_row['patient_name'] == $row['patient_name']) ? 'selected' : '';
                        echo "<option value='".$patient_row['patient_id']."' $selected>".$patient_row['patient_name']."</option>";
                    }
                }
                ?>
            </select>

            <label for="staff_id">Staff Name:</label>
            <select id="staff_id" name="staff_id" required>
                <?php
                // Fetch staff names
                $sql = "SELECT staff_id, name FROM Staff";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($staff_row = $result->fetch_assoc()) {
                        $selected = ($staff_row['name'] == $row['name']) ? 'selected' : '';
                        echo "<option value='".$staff_row['staff_id']."' $selected>".$staff_row['name']."</option>";
                    }
                }
                ?>
            </select>

            <input type="submit" name="update" value="Update Consultation">
        </form>
        <?php
    } else {
        echo "Record not found.";
    }
} else {
    echo "Consultation ID not provided.";
}

$conn->close();
?>
</body>
</html>

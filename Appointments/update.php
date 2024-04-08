<?php
// Include the navbar file

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

// Set character set to utf8mb4
$conn->set_charset("utf8mb4");
mysqli_set_charset($conn, "utf8mb4");

// Fetch data from the Appointments table based on the appointment_id
if (isset($_GET['appointment_id'])) {
    $id = $_GET['appointment_id'];
    $sql = "SELECT a.appointment_id, a.appointment_date, a.appointment_time, a.appointment_reason, p.patient_name, s.name 
    FROM Appointments a
    JOIN Patients p ON p.patient_id = a.patient_id
    JOIN staff s ON s.staff_id = a.staff_id
    WHERE a.appointment_id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Appointments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="date"],
        input[type="time"],
        input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Update Appointments</h2>
    <form method="post" action="update_process.php">
        <input type="hidden" name="appointment_id" value="<?php echo $row['appointment_id']; ?>">
        <label for="appointment_date">Appointment Date:</label>
        <input type="date" name="appointment_date" value="<?php echo $row['appointment_date']; ?>" required>
        <label for="appointment_time">Appointment Time:</label>
        <input type="time" name="appointment_time" value="<?php echo $row['appointment_time']; ?>" required>
        <label for="appointment_reason">Reason:</label>
        <input type="text" name="appointment_reason" value="<?php echo $row['appointment_reason']; ?>" required>
        <label for="patient_name">Patient's Name:</label>
        <input type="text" name="patient_name" value="<?php echo $row['patient_name']; ?>" required>
        <label for="doctor_name">Doctor's Name:</label>
        <input type="text" name="doctor_name" value="<?php echo $row['name']; ?>" required>
        <input type="submit" name="update" value="Update Appointment">
    </form>
</body>
</html>
<?php
    } else {
        echo "Record not found.";
    }
} else {
    echo "Appointment ID not provided.";
}

// Close the connection
$conn->close();
?>

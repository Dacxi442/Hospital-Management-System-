<?php
// Include the navbar file

// Connect to your database
$servername = "localhost";
$username = "root";
$password = "norah#@$&";
$database = "Jamii1_hospital";
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch patients
$sql_patient = "SELECT patient_id, patient_name FROM Patients";
$result_patient = $conn->query($sql_patient);

// Fetch doctors
$sql_doctor = "SELECT staff_id, name FROM Staff";
$result_doctor = $conn->query($sql_doctor);

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Appointment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        h4 {
            margin-bottom: 20px;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="date"],
        input[type="time"],
        select,
        textarea {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        textarea {
            height: 100px;
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
    <h1>Insert Appointment Details</h1>

    <form action="insertData.php" method="post">
        <label for="appointment_date">Appointment Date:</label>
        <input type="date" id="appointment_date" name="appointment_date" required>

        <label for="appointment_time">Appointment Time:</label>
        <input type="time" id="appointment_time" name="appointment_time" required>

        <label for="appointment_reason">Appointment Reason:</label>
        <textarea id="appointment_reason" name="appointment_reason" required></textarea>

        <label for="patient_id">Patient's Name:</label>
        <select id="patient_id" name="patient_id" required>
            <?php while ($row_patient = $result_patient->fetch_assoc()) { ?>
                <option value="<?php echo $row_patient['patient_id']; ?>"><?php echo $row_patient['patient_name']; ?></option>
            <?php } ?>
        </select>

        <label for="staff_id">Doctor's Name:</label>
        <select id="staff_id" name="staff_id" required>
            <?php while ($row_doctor = $result_doctor->fetch_assoc()) { ?>
                <option value="<?php echo $row_doctor['staff_id']; ?>"><?php echo $row_doctor['name']; ?></option>
            <?php } ?>
        </select>

        <input type="submit" value="Add Appointment">
    </form>
</body>
</html>

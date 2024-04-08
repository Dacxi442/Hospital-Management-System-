<!DOCTYPE html>
<html>
<head>
    <title>Update Prescription Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 8px;
            font-weight: bold;
        }
        select,
        input[type="date"],
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin-top: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: auto;
            align-self: flex-end;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Prescription Record</h2>
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

        if (isset($_GET['pres_id'])) {
            $id = $_GET['pres_id'];
            $sql = "SELECT p.pres_id, p.prescription_date, p.medication_detail, pt.patient_name, d.name, m.med_name
                    FROM Prescriptions p
                    JOIN Patients pt ON p.patient_id = pt.patient_id
                    JOIN staff d ON p.staff_id = d.staff_id
                    JOIN Medications m ON p.med_id = m.med_id
                    WHERE p.pres_id = ?";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>
                <form method="post" action="update_process.php">
                    <input type="hidden" name="pres_id" value="<?php echo $row['pres_id']; ?>">
                    <label for="medication_detail">Medication Details:</label>
                    <input type="text" id="medication_detail" name="medication_detail" value="<?php echo $row['medication_detail']; ?>">
                    <label for="prescription_date">Prescription Date:</label>
                    <input type="date" id="prescription_date" name="prescription_date" value="<?php echo $row['prescription_date']; ?>">

                    <label for="patient_id">Patient Name:</label>
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
                    </select>

                    <label for="staff_id">Doctor Name:</label>
                    <select id="staff_id" name="staff_id" required>
                        <?php
                        // Fetch doctor names
                        $sql_doctors = "SELECT staff_id, name FROM staff";
                        $result_doctors = $conn->query($sql_doctors);

                        if ($result_doctors->num_rows > 0) {
                            while ($row_doctor = $result_doctors->fetch_assoc()) {
                                $selected = ($row_doctor['staff_id'] == $row['staff_id']) ? 'selected' : '';
                                echo "<option value='" . $row_doctor['staff_id'] . "' $selected>" . $row_doctor['name'] . "</option>";
                            }
                        }
                        ?>
                    </select>

                    <label for="med_id">Medication:</label>
                    <select id="med_id" name="med_id" required>
                        <?php
                        // Fetch medication names
                        $sql_medications = "SELECT med_id, med_name FROM Medications";
                        $result_medications = $conn->query($sql_medications);

                        if ($result_medications->num_rows > 0) {
                            while ($row_medication = $result_medications->fetch_assoc()) {
                                $selected = ($row_medication['med_id'] == $row['med_id']) ? 'selected' : '';
                                echo "<option value='" . $row_medication['med_id'] . "' $selected>" . $row_medication['med_name'] . "</option>";
                            }
                        }
                        ?>
                    </select>

                    <input type="submit" name="update" value="Update Prescription">
                </form>
        <?php
            } else {
                echo "Record not found.";
            }
            $stmt->close();
        } else {
            echo "Prescription ID not provided.";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>

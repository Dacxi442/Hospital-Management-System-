
<!DOCTYPE html>
<html>
<head>
    <title>Add Prescription</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Prescription</h2>
        <form action="insertData.php" method="post">
            <div class="form-group">
                <label for="medication_detail">Medication Details:</label>
                <input type="text" placeholder="Enter medication details" name="medication_detail" id="medication_detail" required>
            </div>

            <div class="form-group">
                <label for="prescription_date">Prescription Date:</label>
                <input type="date" placeholder="Enter prescription date" name="prescription_date" id="prescription_date" required>
            </div>

            <div class="form-group">
                <label for="patient_id">Patient Name:</label>
                <select id="patient_id" name="patient_id" required>
                    <?php
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
                    $sql = "SELECT patient_id, patient_name FROM Patients";
                    $result = $conn->query($sql);

                    // Display options
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['patient_id'] . "'>" . $row['patient_name'] . "</option>";
                        }
                    }

                    // Close connection
                    $conn->close();
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="med_id">Medication:</label>
                <select id="med_id" name="med_id" required>
                    <?php
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

                    // Fetch medications
                    $sql = "SELECT med_id, med_name FROM Medications";
                    $result = $conn->query($sql);

                    // Display options
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['med_id'] . "'>" . $row['med_name'] . "</option>";
                        }
                    }

                    // Close connection
                    $conn->close();
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="staff_id">Doctor's Name:</label>
                <select id="staff_id" name="staff_id" required>
                    <?php
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

                    // Fetch doctors
                    $sql = "SELECT staff_id, name FROM staff";
                    $result = $conn->query($sql);

                    // Display options
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['staff_id'] . "'>" . $row['name'] . "</option>";
                        }
                    }

                    // Close connection
                    $conn->close();
                    ?>
                </select>
            </div>

            <button type="submit" class="btn">Add Prescription</button>
        </form>
    </div>
</body>
</html>
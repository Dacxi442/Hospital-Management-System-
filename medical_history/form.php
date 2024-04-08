
<!DOCTYPE html>
<html>
<head>
    <title>Insert Medication Details</title>
    <style>
        /* CSS styles */
        form {
            width: 50%;
            margin: auto;
        }

        input[type="text"],
        input[type="date"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h4>Insert Medication Details Here</h4>
    <form action="insertData.php" method="post" onsubmit="return validateForm()">
        <label for="patient_diagnosis">Patient Diagnosis:</label>
        <input type="text" id="patient_diagnosis" placeholder="Enter Patient Diagnosis" name="patient_diagnosis" required><br>

        <label for="medication">Medication:</label>
        <input type="text" id="medication" placeholder="Enter Medication" name="medication" required><br>

        <label for="diagnosis_date">Diagnosis Date:</label>
        <input type="date" id="diagnosis_date" name="diagnosis_date" required><br>

        <label for="notes">Notes:</label>
        <textarea id="notes" name="notes" rows="4" cols="50"></textarea><br>

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
                while($row = $result->fetch_assoc()) {
                    echo "<option value='".$row['patient_id']."'>".$row['patient_name']."</option>";
                }
            }

            // Close connection
            $conn->close();
            ?>
        </select><br>

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

            // Fetch staff
            $sql = "SELECT staff_id, name FROM Staff";
            $result = $conn->query($sql);

            // Display options
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='".$row['staff_id']."'>".$row['name']."</option>";
                }
            }

            // Close connection
            $conn->close();
            ?>
        </select><br>

        <input type="submit" value="Add Medication">
    </form>

    <script>
        // JavaScript validation
        function validateForm() {
            var patient_diagnosis = document.getElementById("patient_diagnosis").value;
            var medication = document.getElementById("medication").value;
            var diagnosis_date = document.getElementById("diagnosis_date").value;
            var notes = document.getElementById("notes").value;
            var patient_id = document.getElementById("patient_id").value;
            var staff_id = document.getElementById("staff_id").value;

            if (patient_diagnosis.trim() === "" || medication.trim() === "" || diagnosis_date.trim() === "" || notes.trim() === "" || patient_id.trim() === "" || staff_id.trim() === "") {
                alert("All fields must be filled out");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>

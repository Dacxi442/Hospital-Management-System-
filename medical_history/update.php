
<!DOCTYPE html>
<html>
<head>
    <title>Update Medical History</title>
    <style>
        /* Add your CSS styles here */
        /* Example styles */
        input[type="text"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
        }
    </style>
    <script>
        // Add your JavaScript validation code here
        // Example JavaScript validation
        function validateForm() {
            var diagnosis = document.forms["updateForm"]["patient_diagnosis"].value;
            var medication = document.forms["updateForm"]["medication"].value;
            var diagnosisDate = document.forms["updateForm"]["diagnosis_date"].value;
            var notes = document.forms["updateForm"]["notes"].value;

            if (diagnosis == "" || medication == "" || diagnosisDate == "" || notes == "") {
                alert("All fields must be filled out");
                return false;
            }
        }
    </script>
</head>
<body>
    <h2>Update Medical History</h2>
    <?php
    // Include the update logic file
    // include 'update_logic.php';

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

    // Fetch data from the Staff table based on the staff_id
    if (isset($_GET['history_id'])) {
        $id = $_GET['history_id'];
        $sql = "SELECT s.history_id, s.Patient_diagnosis, s.medication, s.diagnosis_date, s.notes, p.patient_name, f.name
        FROM patient_medical_history s
        JOIN patients p ON p.patient_id = s.patient_id
        JOIN staff f ON s.staff_id = f.staff_id
                WHERE s.history_id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <form name="updateForm" method="post" action="update_process.php" onsubmit="return validateForm()">
                <input type="hidden" name="history_id" value="<?php echo $row['history_id']; ?>">

                Patient diagnosis:
                <input type="text" placeholder="Enter Patient diagnosis" name="patient_diagnosis" value="<?php echo $row['Patient_diagnosis']; ?>" required>
                Medication:
                <input type="text" placeholder="Enter Medication" name="medication" value="<?php echo $row['medication']; ?>" required>
                Diagnosis Date:
                <input type="date" name="diagnosis_date" value="<?php echo $row['diagnosis_date']; ?>" required>
                Notes:
                <textarea name="notes" placeholder="Enter Notes" required><?php echo $row['notes']; ?></textarea>
                patient name:
                <select id="patient_id" name="patient_id" required>
                    <?php
                        // Fetch 
                        $sql = "SELECT patient_id, patient_name FROM Patients";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='".$row['patient_id']."'>".$row['patient_name']."</option>";
                            }
                        }
                    ?>
                </select><br>

                staff name:
        <select id="staff_id" name="staff_id" required>
            <?php
            // Fetch staff names
            $sql_staff = "SELECT staff_id, name FROM Staff";
            $result_staff = $conn->query($sql_staff);

            if ($result_staff->num_rows > 0) {
                while ($row_staff = $result_staff->fetch_assoc()) {
                    $selected = ($row_staff['staff_id'] == $row['staff_id']) ? 'selected' : '';
                    echo "<option value='" . $row_staff['staff_id'] . "' $selected>" . $row_staff['name'] . "</option>";
                }
            }
            ?>
        </select><br>

        <input type="submit" name="update" value="Update medicals">
    </form>
    <?php
        } else {
          echo "Record not found.";
             }

        } else {
            echo "Staff ID not provided.";
        }
    
        // Close the database connection
        $conn->close();
        ?>
    </body>
    </html>
    
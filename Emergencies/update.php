<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Medical History</title>
<style>
    /* Reset default margin and padding */
    body, h1, p, input, select {
        margin: 0;
        padding: 0;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        color: #333;
        line-height: 1.6;
        padding: 20px;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        background-color: #fff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    form {
        display: grid;
        gap: 10px;
    }

    label {
        font-weight: bold;
    }

    input[type="text"],
    input[type="date"],
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: #00796b;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #005a4f;
    }
</style>
</head>
<body>
<div class="container">
    <h2>Update Medical History</h2>
    <?php
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

    // Fetch data from the Emergencies table based on the emergency_id
    if (isset($_GET['emergency_id'])) {
        $id = $_GET['emergency_id'];
        $sql = "SELECT e.emergency_id, e.emergency_type, e.emergency_date, e.emergency_details, p.empatient_name, f.name
                FROM Emergencies e
                JOIN Emergency_patients p ON p.empatient_id = e.empatient_id
                JOIN staff f ON e.staff_id = f.staff_id
                WHERE e.emergency_id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <form method="post" action="update_process.php">
                <input type="hidden" name="emergency_id" value="<?php echo $row['emergency_id']; ?>">
                
                <label for="emergency_type">Emergency Type:</label>
                <input type="text" id="emergency_type" name="emergency_type" value="<?php echo $row['emergency_type']; ?>" required>

                <label for="emergency_details">Emergency Details:</label>
                <input type="text" id="emergency_details" name="emergency_details" value="<?php echo $row['emergency_details']; ?>" required>

                <label for="emergency_date">Date:</label>
                <input type="date" id="emergency_date" name="emergency_date" value="<?php echo $row['emergency_date']; ?>" required>

                <label for="empatient_id">Patient Name:</label>
                <select id="empatient_id" name="empatient_id" required>
                    <?php
                    // Fetch patient names
                    $sql = "SELECT empatient_id, empatient_name FROM Emergency_patients";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($patient = $result->fetch_assoc()) {
                            $selected = ($patient['empatient_id'] == $row['empatient_id']) ? 'selected' : '';
                            echo "<option value='".$patient['empatient_id']."' $selected>".$patient['empatient_name']."</option>";
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
                        while($staff = $result->fetch_assoc()) {
                            $selected = ($staff['staff_id'] == $row['staff_id']) ? 'selected' : '';
                            echo "<option value='".$staff['staff_id']."' $selected>".$staff['name']."</option>";
                        }
                    }
                    ?>
                </select>

                <input type="submit" name="update" value="Update Medicals">
            </form>
            <?php
        } else {
            echo "Record not found.";
        }
    } else {
        echo "Emergency ID not provided.";
    }

    // Close the database connection
    $conn->close();
    ?>
</div>
</body>
</html>

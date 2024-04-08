<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Insert Members</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        padding: 20px;
    }

    form {
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h4 {
        color: #007bff;
        text-align: center;
        margin-bottom: 20px;
    }

    input[type="text"],
    input[type="date"],
    select {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 16px;
    }

    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    select {
        margin-bottom: 20px;
    }
</style>
</head>
<body>
<h4>Insert Members here</h4>
<form action="insertData.php" method="post">
    <label for="membership_type">Membership Type:</label>
    <input type="text" placeholder="Enter membership type" name="membership_type" required>

    <label for="membership_start_date">Membership Start Date:</label>
    <input type="date" placeholder="Enter membership start date" name="membership_start_date" required>

    <label for="membership_end_date">Membership End Date:</label>
    <input type="date" placeholder="Enter membership end date" name="membership_end_date" required>

    <label for="membership_fee">Membership Fee:</label>
    <input type="text" placeholder="Enter membership fee" name="membership_fee" required>

    <label for="membership_benefits">Membership Benefits:</label>
    <input type="text" placeholder="Enter membership benefits" name="membership_benefits" required>

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
    </select>

    <input type="submit" value="Add Members">
</form>
</body>
</html>

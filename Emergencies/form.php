<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Emergency Details</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        padding: 20px;
    }

    h1 {
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }

    form {
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    input[type="text"],
    input[type="date"],
    select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
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
        font-size: 16px;
        transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>
<h1><b>Insert Emergency Details</b></h1>

<form action="insertData.php" method="post">
    <label for="emergency_type">Emergency Type:</label>
    <input type="text" id="emergency_type" placeholder="Enter Emergency Type" name="emergency_type" required>

    <label for="emergency_details">Emergency Details:</label>
    <input type="text" id="emergency_details" placeholder="Enter Emergency Details" name="emergency_details" required>

    <label for="emergency_date">Date:</label>
    <input type="date" id="emergency_date" name="emergency_date" required>
 
    <label for="empatient_id">Patient Name:</label>
    <select id="empatient_id" name="empatient_id" required>
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
        $sql = "SELECT empatient_id, empatient_name FROM Emergency_patients";
        $result = $conn->query($sql);

        // Display options
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<option value='".$row['empatient_id']."'>".$row['empatient_name']."</option>";
            }
        }

        // Close connection
        $conn->close();
        ?>
    </select>

    <label for="staff_id">Staff Name:</label>
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

        // Fetch staff members
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
    </select>
 
    <input type="submit" value="Add Patient">
</form>
</body>
</html>

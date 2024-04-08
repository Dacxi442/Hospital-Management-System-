<?php

$servername = "localhost";
$username = "root";
$password = "norah#@$&";
$database = "Jamii1_hospital";
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the membership_id from the query parameter
$membership_id = $_GET['membership_id'];

// Fetch the membership data from the database
$sql = "SELECT s.membership_id, s.membership_type, s.membership_start_date, s.membership_end_date, s.membership_fee, s.membership_benefits, p.patient_id, p.patient_name
        FROM patient_membership s
        INNER JOIN Patients p ON s.patient_id = p.patient_id
        WHERE s.membership_id = $membership_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "No record found.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Membership</title>
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
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        textarea {
            height: 100px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Membership</h2>
        <form action="update_process.php" method="post">
            <input type="hidden" name="membership_id" value="<?php echo $row['membership_id']; ?>">

            <div class="form-group">
                <label for="patient_name">Patient Name:</label>
                <input type="text" name="patient_name" id="patient_name" value="<?php echo $row['patient_name']; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="patient_id">Patient ID:</label>
                <input type="text" name="patient_id" id="patient_id" value="<?php echo $row['patient_id']; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="membership_type">Membership Type:</label>
                <input type="text" name="membership_type" id="membership_type" value="<?php echo $row['membership_type']; ?>">
            </div>

            <div class="form-group">
                <label for="membership_start_date">Membership Start Date:</label>
                <input type="date" name="membership_start_date" id="membership_start_date" value="<?php echo $row['membership_start_date']; ?>">
            </div>

            <div class="form-group">
                <label for="membership_end_date">Membership End Date:</label>
                <input type="date" name="membership_end_date" id="membership_end_date" value="<?php echo $row['membership_end_date']; ?>">
            </div>

            <div class="form-group">
                <label for="membership_fee">Membership Fee:</label>
                <input type="number" name="membership_fee" id="membership_fee" value="<?php echo $row['membership_fee']; ?>">
            </div>

            <div class="form-group">
                <label for="membership_benefits">Membership Benefits:</label>
                <textarea name="membership_benefits" id="membership_benefits"><?php echo $row['membership_benefits']; ?></textarea>
            </div>

            <button type="submit" class="btn">Update Membership</button>
        </form>
    </div>
</body>
</html>
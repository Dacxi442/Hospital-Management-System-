<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Home Page</title>
<style>
    /* Reset default margin and padding */
    body, h1, p {
        margin: 0;
        padding: 0;
    }

    .custom-navbar {
        background-color: #333;
        border-radius: 10px;
        margin-bottom: 20px;
        overflow: hidden;
    }

    .custom-navbar a {
        float: left;
        display: block;
        color: white;
        text-align: center;
        padding: 10px 15px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .custom-navbar a:hover {
        background-color: #555;
    }
</style>
</head>
<body>
<div class="container">
    <div class="custom-navbar">
        <?php
        // Array of page names and their corresponding URLs
        $pages = array(
            "Home" => "../layout/admin_dashboard.php",
            "Patients" => "../patients/table.php",
            "Staffs" => "../staff_members/table.php",
            "Departments" => "../department/table.php",
            "Medical History" => "../medical_history/table.php",
            "Membership" => "../patient membership/table.php",
            "Wards" => "../ward/table.php",
            "Beds" => "../beds/table.php",
            "Medications" => "../medications/table.php",
            "Prescriptions" => "../prescriptions/table.php",
            "Billing" => "../billings/table.php",
            "Payments" => "../payment/table.php",
            "Appointments" => "../Appointments/table.php",
            "Emergency Patients" => "../emergency_patients/table.php",
            "Emergencies" => "../Emergencies/table.php",
            "Consultations" => "../consultations/table.php",
            "Post Monitoring" => "../post_service_monitoring/table.php"
        );

        // Iterate through the pages array to generate navlinks
        foreach ($pages as $pageTitle => $pageURL) {
            echo "<a href='$pageURL'>$pageTitle</a>";
        }
        ?>
    </div>
</div>
</body>
</html>

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

// SQL query to retrieve appointment details
$sql = "SELECT a.appointment_id, a.appointment_date, a.appointment_time, a.appointment_reason, p.patient_name, s.name 
        FROM Appointments a
        JOIN Patients p ON p.patient_id = a.patient_id
        JOIN staff s ON s.staff_id = a.staff_id";

$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Appointment Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        h4 {
            margin-top: 20px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        a {
            color: #007bff;
            text-decoration: none;
            margin-right: 10px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Appointment Details</h2>
    <h4><a href="form.php">Add Appointment Details</a></h4>
    <table>
        <tr>
            <th>Appointment Date</th>
            <th>Appointment Time</th>
            <th>Appointment Reason</th>
            <th>Patient's Name</th>
            <th>Doctor's Name</th>
            <th>Action</th>
        </tr>
        <?php if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $row["appointment_date"]; ?></td>
            <td><?php echo $row["appointment_time"]; ?></td>
            <td><?php echo $row["appointment_reason"]; ?></td>
            <td><?php echo $row["patient_name"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td>
                <a href="update.php?appointment_id=<?php echo $row["appointment_id"]; ?>">Update</a>
                <a href="delete.php?appointment_id=<?php echo $row["appointment_id"]; ?>" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
            </td>
        </tr>
        <?php
            }
        } else {
        ?>
        <tr>
            <td colspan="6">No records found</td>
        </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>

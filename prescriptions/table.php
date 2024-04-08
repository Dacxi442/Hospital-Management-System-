


<!-- navbar links separate -->
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

$servername = "localhost";
$username = "root";
$password = "norah#@$&";
$database = "Jamii1_hospital";
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL statement
$sql = "SELECT p.pres_id, p.prescription_date, p.medication_detail, pt.patient_name, d.name, m.med_name
 FROM Prescriptions p
 JOIN Patients pt ON p.patient_id = pt.patient_id
 JOIN staff d ON p.staff_id = d.staff_id 
 JOIN Medications m ON p.med_id = m.med_id";
$stmt = $conn->prepare($sql);

// Execute the prepared statement
$stmt->execute();
$result = $stmt->get_result();

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Prescription Details</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            text-decoration: none;
            margin-left: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0069d9;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Prescription Details</h2>
        <div class="actions">
            <a href="form.php" class="btn">Add Prescription</a>
        </div>
        <table>
            <tr>
                <th>Medication Details</th>
                <th>Prescription Date</th>
                <th>Patient Name</th>
                <th>Doctor Name</th>
                <th>Medication Name</th>
                <th>Action</th>
            </tr>
            <?php if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $row["medication_detail"]; ?></td>
                        <td><?php echo $row["prescription_date"]; ?></td>
                        <td><?php echo $row["patient_name"]; ?></td>
                        <td><?php echo $row["name"]; ?></td>
                        <td><?php echo $row["med_name"]; ?></td>
                        <td class="actions">
                            <a href="update.php?pres_id=<?php echo $row["pres_id"]; ?>" class="btn">Update</a>
                            <a href="#" class="btn btn-danger" onclick="confirmDelete(<?php echo $row["pres_id"]; ?>)">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan='6'>No records found</td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>

    <script>
        function confirmDelete(presId) {
            if (confirm("Are you sure you want to delete this record?")) {
                window.location.href = `delete.php?pres_id=${presId}`;
            }
        }
    </script>
</body>
</html>
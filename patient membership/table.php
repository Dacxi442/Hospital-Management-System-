
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




<!DOCTYPE html>
<html>
<head>
    <title>Membership Details</title>
    <style>
        /* CSS Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            margin: 0 auto;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

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

        .btn {
            display: inline-block;
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            text-decoration: none;
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

        .actions {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .actions .btn {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <?php
    // Include the navbar file
    // include 'C:/wamp64/www/hospital/layout/navbar.php';

    $servername = "localhost";
    $username = "root";
    $password = "norah#@$&";
    $database = "Jamii1_hospital";
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from patient membership table joining with patients table
    $sql = "SELECT s.membership_id, s.membership_type, s.membership_start_date, s.membership_end_date, s.membership_fee, s.membership_benefits, p.patient_name FROM patient_membership s INNER JOIN Patients p ON s.patient_id = p.patient_id";
    $result = $conn->query($sql);
    $conn->close();
    ?>

    <div class="container">
        <h2>Membership Details</h2>
        <div class="actions">
            <a href="form.php" class="btn">Add Members</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Membership Type</th>
                    <th>Membership Start Date</th>
                    <th>Membership End Date</th>
                    <th>Membership Fee</th>
                    <th>Membership Benefits</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row["patient_name"] ?></td>
                            <td><?php echo $row["membership_type"] ?></td>
                            <td><?php echo $row["membership_start_date"] ?></td>
                            <td><?php echo $row["membership_end_date"] ?></td>
                            <td><?php echo $row["membership_fee"] ?></td>
                            <td><?php echo $row["membership_benefits"] ?></td>
                            <td class="actions">
                                <a href="update.php?membership_id=<?php echo $row["membership_id"]; ?>" class="btn">Update</a>
                                <a href="#" class="btn btn-danger" onclick="confirmDelete(<?php echo $row["membership_id"]; ?>)">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan='7'>No records found</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        // JavaScript Function
        function confirmDelete(membershipId) {
            if (confirm("Are you sure you want to delete this record?")) {
                window.location.href = `delete.php?membership_id=${membershipId}`;
            }
        }
    </script>
</body>
</html>
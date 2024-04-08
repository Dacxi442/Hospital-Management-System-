
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
    <title>Emergency Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td a {
            display: inline-block;
            padding: 5px 10px;
            color: #007bff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        td a:hover {
            background-color: #007bff;
            color: #fff;
        }

        .add-link {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php


    // Database connection details
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

    // SQL query to retrieve emergency details
    $sql = "SELECT e.emergency_id, e.emergency_type, e.emergency_date,e.emergency_details, p.empatient_name, f.name
    FROM Emergencies e
    JOIN Emergency_patients p ON p.empatient_id = e.empatient_id
    JOIN staff f ON e.staff_id = f.staff_id";

    $result = $conn->query($sql);

    // Close the database connection
    $conn->close();
    ?>

    <h2>Emergency Details</h2>
    <div class="add-link">
        <a href="form.php">Add Emergency Details</a>
    </div>
    <table>
        <tr>
            <th>Emergency Type</th>
            <th>Emergency Details</th>
            <th>Date</th>
            <th>Patient's Name</th>
            <th>Action</th>
        </tr>
        <?php if ($result->num_rows > 0) { ?>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row["emergency_type"]; ?></td>
                    <td><?php echo $row["emergency_details"]; ?></td>
                    <td><?php echo $row["emergency_date"]; ?></td>
                    <td><?php echo $row["empatient_name"]; ?></td>
                    <td>
                        <a href="update.php?emergency_id=<?php echo $row["emergency_id"]; ?>">Update</a>
                        <a href="delete.php?emergency_id=<?php echo $row["emergency_id"]; ?>" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr><td colspan="5">No records found</td></tr>
        <?php } ?>
    </table>
</body>
</html>

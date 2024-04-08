
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
    <title>Medication Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
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
            margin-bottom: 10px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0069d9;
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

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Medication Records</h2>
        <a href="form.php" class="btn">Add Medication</a>

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

        // SQL query to select data from the medication table
        $sql = "SELECT * FROM Medications";

        // Execute the query
        $result = $conn->query($sql);
        ?>

        <table>
            <tr>
                <th>Medication Name</th>
                <th>Dosage Form</th>
                <th>Actions</th>
            </tr>
            <?php
            // Check if there are any results/data
            if ($result->num_rows > 0) {
                // Loop through each row and display the data
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $row["med_name"]; ?></td>
                        <td><?php echo $row["dosage_form"]; ?></td>
                        <td>
                            <a href="update.php?med_id=<?php echo $row["med_id"]; ?>" class="btn">Update</a>
                            <a href="delete.php?med_id=<?php echo $row["med_id"]; ?>" class="btn" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="3">No records found.</td>
                </tr>
                <?php
            }
            ?>
        </table>

        <?php
        // Close the connection
        $conn->close();
        ?>
    </div>
</body>
</html>
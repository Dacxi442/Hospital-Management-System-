
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Records</title>
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
            max-width: 1200px;
            margin: 0 auto;
        }

        h2 {
            color: #007bff;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        .action-links {
            display: flex;
            gap: 10px;
        }

        .delete-link {
            color: red;
            cursor: pointer;
        }

        .delete-link:hover {
            text-decoration: underline;
        }

        .simple-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .simple-button:hover {
            background-color: #1f1f1f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Department Records</h2>
        <button class="simple-button">
            <a href="form.php" style="color: white; text-decoration: none;">Add Department</a>
        </button>
        <table>
            <tr>
                <th>Department Name</th>
                <th>Description</th>
                <th>Department Type</th>
                <th>Actions</th>
            </tr>
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

            // SQL query to select data from the departments table
            $sql = "SELECT * FROM Departments";

            // Execute the query
            $result = $conn->query($sql);

            // Check if there are any results/data
            if ($result->num_rows > 0) {
                // Loop through each row and display the data
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $row["dept_name"]; ?></td>
                        <td><?php echo $row["description"]; ?></td>
                        <td><?php echo $row["department_type"]; ?></td>
                        <td class="action-links">
                            <a href="update.php?dept_id=<?php echo $row["dept_id"]; ?>" class="simple-button">Update</a>
                            <span class="simple-button delete-link" onclick="confirmDelete(<?php echo $row['dept_id']; ?>)">Delete</span>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="4">No records found.</td>
                </tr>
                <?php
            }

            // Close the connection
            $conn->close();
            ?>
        </table>
    </div>
    <script>
        function confirmDelete(deptId) {
            if (confirm("Are you sure you want to delete this record?")) {
                window.location.href = "delete.php?dept_id=" + deptId;
            }
        }
    </script>
</body>
</html>
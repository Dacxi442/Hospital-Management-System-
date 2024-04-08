
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
    <title>Emergency Records</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            color: #333;
        }

        tr:hover {
            background-color: #f0f0f0;
        }

        th {
            background-color: #f2f2f2;
        }
/* 
        a {
            text-decoration: none;
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #0056b3;
        } */
    </style>
</head>
<body>
    <div class="container">
        <h2>Emergency Records</h2>
        <a href="form.php">Add Patients</a>
        <table>
            <tr>
                <th>Name</th>
                <th>Contact</th>
                <th>Date Added</th>
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

            // SQL query to select data from the emergency patients table
            $sql = "SELECT * FROM Emergency_patients";

            // Execute the query
            $result = $conn->query($sql);

            // Check if there are any results
            if ($result->num_rows > 0) {
                // Loop through each row and display the data
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $row["empatient_name"]; ?></td>
                        <td><?php echo $row["contact"]; ?></td>
                        <td><?php echo $row["datetime_added"]; ?></td>
                        <td>
                            <a href="update.php?empatient_id=<?php echo $row["empatient_id"]; ?>">Update</a>
                            <a href="delete.php?empatient_id=<?php echo $row["empatient_id"]; ?>" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
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
</body>
</html>

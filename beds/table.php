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
        position: relative;
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
// Connect to your database (assuming you're using MySQL)
$servername = "localhost";
$username = "root";
$password = "norah#@$&";
$database = "Jamii1_hospital";
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from Beds table joining with Wards table
$sql = "SELECT b.bed_id, b.bed_number, b.status, w.ward_name, w.ward_id FROM Beds b INNER JOIN Wards w ON b.ward_id = w.ward_id";

$result = $conn->query($sql);
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bed Details</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        h4 a {
            color: #007bff;
            text-decoration: none;
        }

        h4 a:hover {
            text-decoration: underline;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #333;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        /* Button Styles */
        a {
            display: inline-block;
            padding: 6px 12px;
            font-size: 14px;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
            margin-right: 5px;
        }

        a.btn-primary {
            background-color: #007bff;
            border: 1px solid #007bff;
            color: #fff;
        }

        a.btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        a.btn-danger {
            background-color: #dc3545;
            border: 1px solid #dc3545;
            color: #fff;
        }

        a.btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Bed Details</h2>
        <h4><a href="form.php">add bed</a></h4>
        <table>
            <tr>
                <th>Ward Name</th>
                <th>Bed Number</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $row["ward_name"] ?></td>
                        <td><?php echo $row["bed_number"] ?></td>
                        <td><?php echo $row["status"] ?></td>
                        <td>
                            <a href="update.php?bed_id=<?php echo $row["bed_id"]; ?>" class="btn-primary">Update</a>
                            <a href="delete.php?bed_id=<?php echo $row["bed_id"]; ?>" class="btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan='4'>No records found</td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</body>
</html>
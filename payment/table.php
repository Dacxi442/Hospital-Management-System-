

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

// Fetch data from payment table joining with patients and billings tables
$sql = "SELECT p.payment_id, p.payment_date, p.amount, p.payment_method, pt.patient_name, b.total_amount
        FROM Payments p
        JOIN Patients pt ON p.patient_id = pt.patient_id
        JOIN Billings b ON p.bill_id = b.bill_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        }

        .btn {
            margin-bottom: 10px;
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Payment Details</h2>
        <a href="form.php" class="btn btn-primary">Add Payment</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Payment Date</th>
                    <th>Amount Paid</th>
                    <th>Payment Method</th>
                    <th>Patient Name</th>
                    <th>Total Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row["payment_date"]; ?></td>
                            <td><?php echo $row["amount"]; ?></td>
                            <td><?php echo $row["payment_method"]; ?></td>
                            <td><?php echo $row["patient_name"]; ?></td>
                            <td><?php echo $row["total_amount"]; ?></td>
                            <td>
                                <a href="update.php?payment_id=<?php echo $row["payment_id"]; ?>" class="btn btn-sm btn-primary">Update</a>
                                <a href="delete.php?payment_id=<?php echo $row["payment_id"]; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
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
            </tbody>
        </table>
    </div>

    <?php
    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
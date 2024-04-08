<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {

            font-family: Arial, sans-serif;
            background-color: grey;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .link-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        .link-box {
            padding: 20px;
            background-color: #f0f0f0;
            color: #333;
            text-align: center;
            border-radius: 10px;
            transition: background-color 0.3s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .link-box:hover {
            background-color: teal;
        }
        a {
            text-decoration: none;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <div class="link-grid">
            <a href="../layout/index.php" class="link-box">Home</a>
            <a href="../patients/table.php" class="link-box">Patients</a>
            <a href="../staff_members/table.php" class="link-box">Staff Members</a>
            <a href="../department/table.php" class="link-box">Departments</a>
            <a href="../medical_history/table.php" class="link-box">Medical History</a>
            <a href="../patient membership/table.php" class="link-box">Membership</a>
            <a href="../ward/table.php" class="link-box">Wards</a>
            <a href="../beds/table.php" class="link-box">Beds</a>
            <a href="../medications/table.php" class="link-box">Medications</a>
            <a href="../prescriptions/table.php" class="link-box">Prescriptions</a>
            <a href="../billings/table.php" class="link-box">Billing</a>
            <a href="../payment/table.php" class="link-box">Payments</a>
            <a href="../Appointments/table.php" class="link-box">Appointments</a>
            <a href="../emergency_patients/table.php" class="link-box">Emergency Patients</a>
            <a href="../Emergencies/table.php" class="link-box">Emergencies</a>
            <a href="../consultations/table.php" class="link-box">Consultations</a>
            <a href="../chats/table.php" class="link-box">Chats</a>
            <a href="../chat_messages/table.php" class="link-box">Chat Messages</a>
            <a href="../post_service_monitoring/table.php" class="link-box">Post Monitoring</a>
        </div>
    </div>
</body>
</html>

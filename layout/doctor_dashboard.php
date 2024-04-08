<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <style>
        body {
            background-color: grey;

            font-family: Arial, sans-serif;
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
            border-radius: 8px;
            transition: background-color 0.3s, transform 0.3s;
            text-decoration: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .link-box:hover {
            background-color: teal;
            transform: translateY(-2px);
        }
        .welcome-message {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
            color: #555;
        }
        .profile-link {
            text-align: center;
            margin-top: 30px;
        }
        .profile-link a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }
        .profile-link a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Doctor Dashboard</h1>
        <p class="welcome-message">Welcome</p>
        <div class="link-grid">
            <a href="../layout/index.php" class="link-box">Home</a>
            <a href="../patients/table.php" class="link-box">Patients</a>
            <a href="../department/table.php" class="link-box">Departments</a>
            <a href="../medical_history/table.php" class="link-box">Medical History</a>
            <a href="../patient membership/table.php" class="link-box">Membership</a>
            <a href="../medications/table.php" class="link-box">Medications</a>
            <a href="../prescriptions/table.php" class="link-box">Prescriptions</a>
            <a href="../Appointments/table.php" class="link-box">Appointments</a>
            <a href="../emergency_patients/table.php" class="link-box">Emergency Patients</a>
            <a href="../Emergencies/table.php" class="link-box">Emergencies</a>
            <a href="../consultations/table.php" class="link-box">Consultations</a>
            <a href="../post_service_monitoring/table.php" class="link-box">Post Monitoring</a>
        </div>
        <!-- <div class="profile-link">
            <a href="../profile.php">View Profile</a>
        </div> -->
    </div>
</body>
</html>

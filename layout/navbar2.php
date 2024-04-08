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

    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        color: #333;
        line-height: 1.6;
        padding: 20px;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .navbar {
        background-color: #333;
        border-radius: 10px;
        margin-bottom: 20px;
        overflow: hidden;
    }

    .navbar a {
        float: left;
        display: block;
        color: white;
        text-align: center;
        padding: 10px 15px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .navbar a:hover {
        background-color: #555;
    }

    section {
        background-color: #00796b;
        color: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    section h2 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    section p {
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 20px;
    }

    .grid-item {
        background-color: #ffffff;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease;
        text-align: center;
    }

    .grid-item:hover {
        background-color: #f0f0f0;
    }

    .grid-item a {
        text-decoration: none;
        color: #333;
        font-weight: bold;
        font-size: 14px;
    }
</style>
</head>
<body>
<div class="container">
    <div class="navbar">
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
            // "Chats" => "../chats/table.php",
            // "Chat messages" => "../chat_messages/table.php",
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

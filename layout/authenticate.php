<?php
session_start(); // Start the session

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

// Retrieve username, password, and role from the form
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

// Prepare SQL statement to fetch user data
$stmt = $conn->prepare("SELECT id, username, role FROM Login WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows == 1) {
    // User authenticated, set session variables
    $user = $result->fetch_assoc();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    // Redirect to dashboard or home page based on role
    switch ($role) {
        case 'admin':
            header("Location: admin_dashboard.php");
            break;
        case 'doctor':
            header("Location: doctor_dashboard.php");
            break;
        case 'receptionist':
            header("Location: receptionist_dashboard.php");
            break;
        case 'accountant':
            header("Location: accountant_dashboard.php");
            break;
        case 'matron':
            header("Location: matron_dashboard.php");
            break;
        default:
            header("Location: login.php"); // Redirect to login page if role is not recognized
            break;
    }
    exit();
} else {
    // Authentication failed, redirect to login page with error message
    header("Location: login.php?error=1");
    exit();
}

// Close statement and connection
$stmt->close();
$conn->close();
?>

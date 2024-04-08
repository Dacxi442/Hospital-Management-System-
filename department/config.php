<?php
// Database connection details
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'norah#@$&');
define('DB_NAME', 'Jamii1_hospital');

// Path to the navbar file
define('NAVBAR_PATH', 'C:/wamp64/www/hospital/layout/navbar.php');
?>A
<?php
// Include config file
require_once 'config.php';

// Attempt to connect to MySQL database
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
A
<?php
// Check user's role and redirect if not authorized
function checkRole($allowedRoles) {
    // Check if user is logged in and has the required role
    if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $allowedRoles)) {
        // Redirect to login page or display an error message
        header("Location: login.php?error=unauthorized");
        exit();
    }
}
?>

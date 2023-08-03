<?php
// Start the session (if not already started)
session_start();

unset($_SESSION['user_id']);
unset($_SESSION['username']);
// Destroy the session and unset all session data
session_destroy();

// Redirect the user to the login page or any other page after logout
header("Location: login.html");
exit();
?>
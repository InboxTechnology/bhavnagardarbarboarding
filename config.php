<?php
// Replace these with your actual database credentials
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "bhavnagarboarding";

// Connect to the database
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
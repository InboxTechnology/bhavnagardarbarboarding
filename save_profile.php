<?php
// Save the profile details in the database
// Return success or error response
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $city = $_POST['city'];

    // Query to save the profile details in the database
    $query = "INSERT INTO userprofile (username, city) VALUES ('$username', '$city')";
    if ($conn->query($query) === true) {
        http_response_code(200);
        echo json_encode(['success' => true, 'message' => 'Profile details saved successfully']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error saving profile details']);
    }

    // Close the connection
    $conn->close();
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}

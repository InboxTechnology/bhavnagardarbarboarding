<?php
// Check if the mobile number exists in the database
// Return success or error response
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mobile = $_POST['mobile'];

    // Query to check if the mobile number exists in the database
    $query = "SELECT * FROM mobile_table WHERE mobile = '$mobile'";
    $result = $conn->query($query);

    // Check if a row is found in the result
    if ($result->num_rows > 0) {
        http_response_code(200);
        echo json_encode(['success' => true, 'message' => 'Mobile number exists']);
    } else {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Mobile number does not exist']);
    }

    // Close the connection
    $conn->close();
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}

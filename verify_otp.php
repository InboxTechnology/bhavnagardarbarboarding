<?php
require 'firebase-php/vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

// Replace with the path to your Firebase Admin SDK JSON file
$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/path/to/serviceAccount.json');

$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->create();

$auth = $firebase->getAuth();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mobile = $_POST['mobile'];

    // Generate a random 6-digit OTP
    $otp = rand(100000, 999999);

    // Send the OTP to the user's mobile number using Firebase
    try {
        // Use Firebase's Phone Auth to send the OTP via SMS
        $auth->sendSignInLinkToPhoneNumber($mobile, $otp);
        // Alternatively, you can use Firebase's Email Auth to send the OTP via email
        // $auth->sendSignInLinkToEmail($mobile, $otp);

        http_response_code(200);
        echo json_encode(['success' => true, 'message' => 'OTP sent successfully', 'otp' => $otp]);
    } catch (\Throwable $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Failed to send OTP']);
    }
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}

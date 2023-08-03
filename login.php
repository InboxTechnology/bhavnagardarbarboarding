<?php
include 'config.php';
session_start();
// Function to sanitize user inputs
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = sanitize_input($_POST["username"]);
    $password = sanitize_input($_POST["password"]);

    $hashedPassword = md5($password);
    // Check user credentials
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$hashedPassword'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        
        // Login successful, redirect to admin dashboard
        header("Location: index.php");
        exit();
    } else {
        // Invalid credentials, show an error message or redirect to login page
        echo "Invalid username or password. Please try again.";
    }
}
$conn->close();
?>

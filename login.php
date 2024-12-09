<?php
header('Content-Type: application/json');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Read the input JSON
$input = json_decode(file_get_contents('php://input'), true);

// Check if the email and password are provided
if (empty($input['email']) || empty($input['password'])) {
    echo json_encode(['success' => false, 'message' => 'Email and password are required.']);
    exit();
}

$email = $input['email'];
$password = $input['password']; // Use plain password for comparison

// Database connection
$conn = new mysqli('indieband', 'root', '', 'indieband_db');

// Check for database connection errors
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit();
}

// Fetch user from the database
$stmt = $conn->prepare('SELECT * FROM users WHERE email = ?');
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid email or password.']);
} else {
    $user = $result->fetch_assoc();

    // Compare the plain password
    if ($user['password'] === $password) {
        echo json_encode(['success' => true, 'message' => 'Login successful.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid email or password.']);
    }
}

$stmt->close();
$conn->close();
?>

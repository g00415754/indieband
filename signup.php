<?php
header('Content-Type: application/json');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Read the input JSON
$input = json_decode(file_get_contents('php://input'), true);

// Check if all required fields are provided
if (empty($input['username']) || empty($input['email']) || empty($input['password'])) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit();
}

$username = $input['username'];
$email = $input['email'];
$password = $input['password']; // No hashing here, use plain password

// Database connection
$conn = new mysqli('indieband', 'root', '', 'indieband_db');

// Check for database connection errors
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit();
}

// Check if email already exists
$stmt = $conn->prepare('SELECT * FROM users WHERE email = ?');
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Email already registered.']);
} else {
    // Insert the new user with plain password
    $stmt = $conn->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
    $stmt->bind_param('sss', $username, $email, $password);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Signup successful.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Signup failed: ' . $stmt->error]);
    }
}

$stmt->close();
$conn->close();
?>

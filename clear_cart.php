<?php
session_start();

// Clear the cart in the session
$_SESSION['cart'] = [];

// Return success message to the frontend
echo json_encode(['success' => true]);
?>

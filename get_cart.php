<?php
session_start();

// Check if the cart exists in the session, otherwise return an empty cart
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Return the cart as a JSON response
echo json_encode(['success' => true, 'cart' => $cart]);
?>

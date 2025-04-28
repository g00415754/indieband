<?php
session_start();

// Retrieve JSON data sent from JavaScript
$data = json_decode(file_get_contents('php://input'), true);

// Initialize the cart session if not already done
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Create the item structure to store in the session
$item = [
    'item_id' => $data['item_id'],
    'name' => $data['name'],
    'price' => $data['price'],
    'item_image_ref' => $data['item_image_ref'],
    'quantity' => 1  // Default quantity to 1
];

// Check if the item already exists in the cart and update its quantity
$found = false;
foreach ($_SESSION['cart'] as &$cart_item) {
    if ($cart_item['item_id'] == $item['item_id']) {
        $cart_item['quantity'] += 1;
        $found = true;
        break;
    }
}
unset($cart_item);  // Unset reference to prevent issues

// If the item is not found, add it to the cart
if (!$found) {
    $_SESSION['cart'][] = $item;
}

// Return success and the updated cart to the frontend
echo json_encode(['success' => true, 'cart' => $_SESSION['cart']]);
?>

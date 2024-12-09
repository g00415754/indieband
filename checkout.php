<?php
// Database connection
$conn = new mysqli("indieband", "root", "", "indieband_db");

if ($conn->connect_error) {
    echo "Database connection failed: " . $conn->connect_error;
    exit;
}

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Hardcoded user ID
    $user_id = 10;

    // Retrieve total price
    $total_price = isset($_POST['total']) ? floatval($_POST['total']) : 0;

    // Validate total price
    if ($total_price <= 0) {
        echo "Invalid total price";
        exit;
    }

    // Insert into orders table
    $sql = "INSERT INTO orders (user_id, order_date, total_price) VALUES (?, NOW(), ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('id', $user_id, $total_price);

    if ($stmt->execute()) {
        $order_id = $stmt->insert_id;

        // Insert into order_items table
        $item_sql = "INSERT INTO order_items (order_id, item_id, quantity, price) VALUES (?, ?, ?, ?)";
        $item_stmt = $conn->prepare($item_sql);

        foreach ($_POST as $key => $value) {
            if (strpos($key, 'items') === 0 && is_array($value)) {
                foreach ($value as $item) {
                    $item_id = isset($item['item_id']) ? intval($item['item_id']) : 0;
                    $quantity = isset($item['quantity']) ? intval($item['quantity']) : 0;
                    $price = isset($item['price']) ? floatval($item['price']) : 0;

                    if ($item_id > 0 && $quantity > 0 && $price > 0) {
                        $item_stmt->bind_param('iiii', $order_id, $item_id, $quantity, $price);
                        $item_stmt->execute();
                    }
                }
            }
        }

        echo "Order placed successfully. Order ID: $order_id";
    } else {
        echo "Failed to place order: " . $stmt->error;
    }
} else {
    echo "Invalid request method";
}

$conn->close();
?>

<?php
session_start();


// Create connection
$conn = new mysqli('indieband', 'root', '', 'indieband_db');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch cart from session if available
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Initialize subtotal
$subtotal = 0;
foreach ($cart as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}

// Set shipping cost based on subtotal
$shipping_cost = $subtotal > 85.00 ? 0 : 9.99;
$total_cost = $subtotal + $shipping_cost;

if (!isset($_SESSION['user_email'])) {
    header('Location: user.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_SESSION['user_email'];

    $card_number = isset($_POST['ccnum']) ? trim($_POST['ccnum']) : '';
    $expiry_month = isset($_POST['expmonth']) ? trim($_POST['expmonth']) : '';
    $expiry_year = isset($_POST['expyear']) ? trim($_POST['expyear']) : '';
    $billing_address = isset($_POST['address']) ? trim($_POST['address']) : '';

    // Validate form data
    if (empty($card_number) || empty($expiry_month) || empty($expiry_year) || empty($billing_address)) {
        $error_message = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format.";
    } elseif (!preg_match("/^\d{16}$/", $card_number)) {
        $error_message = "Credit card number must be 16 digits.";
    } elseif (!preg_match("/^\d{2}$/", $expiry_month) || !preg_match("/^\d{4}$/", $expiry_year)) {
        $error_message = "Invalid expiry date.";
    } else {
        // Save billing info in the database
        $user_query = "SELECT user_id FROM users WHERE email = ?";
        $user_stmt = $conn->prepare($user_query);
        $user_stmt->bind_param("s", $email);
        $user_stmt->execute();
        $user_stmt->bind_result($user_id);
        $user_stmt->fetch();
        $user_stmt->close();

        if ($user_id) {
            $expiry_date = $expiry_month . '/' . $expiry_year;
            $stmt = $conn->prepare("UPDATE users SET card_number = ?, expiry_date = ?, billing_address = ? WHERE email = ?");
            $stmt->bind_param("ssss", $card_number, $expiry_date, $billing_address, $email);

            if ($stmt->execute()) {
                // Insert order details
                $cart_items = $_SESSION['cart'] ?? [];
                $total_amount = 0;
                foreach ($cart_items as $item) {
                    $total_amount += $item['quantity'] * $item['price'];
                }

                $payment_status = 'Pending';

                $order_query = "INSERT INTO orders (user_id, total_amount, billing_address, payment_status) VALUES (?, ?, ?, ?)";
                $order_stmt = $conn->prepare($order_query);
                $order_stmt->bind_param("idss", $user_id, $total_amount, $billing_address, $payment_status);

                if ($order_stmt->execute()) {
                    $order_id = $conn->insert_id;

                    $order_items_query = "INSERT INTO Order_Items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
                    $order_items_stmt = $conn->prepare($order_items_query);

                    foreach ($cart_items as $item) {
                        $product_id = $item['product_id'];
                        $quantity = $item['quantity'];
                        $price = $item['price'];

                        $order_items_stmt->bind_param("iiii", $order_id, $product_id, $quantity, $price);
                        $order_items_stmt->execute();
                    }

                    unset($_SESSION['cart']); // Clear the cart
                    header('Location: order-success.php'); // Redirect to order success page
                    exit();
                } else {
                    $error_message = "Error inserting order: " . $order_stmt->error;
                }
            } else {
                $error_message = "Error saving billing info: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $error_message = "User not found.";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .checkout-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .form-section {
            margin-bottom: 30px;
        }

        .order-summary {
            background-color: #f1f3f5;
            border-radius: 10px;
            padding: 20px;
        }

        .order-item {
            border-bottom: 1px solid #dee2e6;
            padding: 10px 0;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .total {
            font-size: 1.2rem;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="shipping text-light text-center p-2" style="height: 30px;font-size: 12px">
        <p>Free Shipping on orders over €85</p>
    </div>

    <div class="banner hstack gap-3 text-bg-light">
        <div class=""><i class="bi bi-search"></i></div>

        <div class=" ms-auto">
            <h1 class="brand">
                <a href="index.php">
                    <img src="images/band-logo.png" alt="band logo" style="height: 200px;">
                </a>
            </h1>
        </div>

        <div class=" ms-auto d-flex align-items-center gap-2">
            <i class="bi bi-person"></i>

            <?php if (isset($_SESSION['user_email'])): ?>
                <span>
                    <?php echo ucfirst(explode('@', $_SESSION['username'])[0]); ?>
                </span>
                <a href="user.php" class="btn btn-danger btn-sm">Logout</a>
            <?php else: ?>
                <a href="user.php" class="btn btn-success btn-sm">Log In</a>
            <?php endif; ?>
        </div>

        <!-- Cart Icon -->
        <button class="btn" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas" aria-controls="cartOffcanvas">
            <i class="bi bi-bag"></i>
        </button>
    </div>

    <nav class="navbar navbar-expand-lg bg-dark-subtle sticky-top" data-bs-theme="dark">
        <div class="container-fluid">
            <!-- Navbar Toggler Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="bi bi-list"></span>
            </button>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse text-center justify-content-center" id="navbarNav">
                <ul class="navbar-nav mx-auto text-center">
                    <li class="nav-item">
                        <a class="nav-link text-light" href="bandshop.php">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="tour.php">Tour</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="about-the-band.php">The Band</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="songs.php">Songs</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br><br><br>
    <div class="container">
        <div class="row g-5">

            <!-- LEFT SIDE: Billing, Shipping, Payment -->
            <div class="col-md-7">
                <div class="checkout-container">
                    <h2 class="mb-4">Checkout</h2>

                    <form action="order-success.php" method="POST">
                        <!-- Billing Details -->
                        <div class="form-section">
                            <h4>Shipping Details</h4>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="billingFirstName" class="form-label">First Name</label>
                                    <input type="text" id="billingFirstName" name="billingFirstName"
                                        class="form-control" required>
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="billingLastName" class="form-label">Last Name</label>
                                    <input type="text" id="billingLastName" name="billingLastName" class="form-control"
                                        required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="billingAddress" class="form-label">Address</label>
                                    <input type="text" id="billingAddress" name="billingAddress" class="form-control"
                                        required>
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="billingCity" class="form-label">City</label>
                                    <input type="text" id="billingCity" name="billingCity" class="form-control"
                                        required>
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="billingPostcode" class="form-label">Eircode</label>
                                    <input type="text" id="billingPostcode" name="billingPostcode" class="form-control"
                                        required>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Information -->
                        <div class="form-section">
                            <h4>Payment Information</h4>
                            <div class="mb-3">
                                <label for="ccnum" class="form-label">Card Number</label>
                                <input type="text" id="ccnum" name="ccnum" class="form-control" required>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="expmonth" class="form-label">Expiry Date (MM)</label>
                                    <input type="text" id="expmonth" name="expmonth" class="form-control" required>
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="expyear" class="form-label">Expiry Date (YY)</label>
                                    <input type="text" id="expyear" name="expyear" class="form-control" required>
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-dark w-100">Complete Purchase</button>
                    </form>
                </div>
            </div>

            <!-- RIGHT SIDE: Order Summary -->
            <div class="col-md-5">
                <div class="order-summary">
                    <h4 class="mb-4">Order Summary</h4>

                    <div id="cartItems">
                        <!-- Cart items will be dynamically inserted here -->
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping</span>
                        <span id="shippingCost">€9.99</span>
                    </div>

                    <div class="d-flex justify-content-between total">
                        <span>Total</span>
                        <span id="totalCost">€0.00</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

      <!-- Footer -->
  <footer class="py-4 bg-dark text-white text-center mt-5">
    <div class="container">
      <p>© 2024 Lunar Coast.</p>
      <div>
        <a href="#" class="text-white mx-2">Facebook</a>
        <a href="#" class="text-white mx-2">Instagram</a>
        <a href="#" class="text-white mx-2">Twitter</a>
      </div>
    </div>
  </footer> 
    <script>
        const cart = <?php echo json_encode($_SESSION['cart'] ?? []); ?>;

        const cartItemsContainer = document.getElementById('cartItems');
        const shippingCostElement = document.getElementById('shippingCost');
        const totalCostElement = document.getElementById('totalCost');

        function updateSummary() {
            cartItemsContainer.innerHTML = '';
            let subtotal = 0;

            // Loop through cart to calculate subtotal
            cart.forEach(item => {
                subtotal += item.price * item.quantity; // Multiply by quantity
                const itemDiv = document.createElement('div');
                itemDiv.classList.add('order-item', 'd-flex', 'justify-content-between');
                itemDiv.innerHTML = `<span>${item.name}</span><span>€${(item.price * item.quantity).toFixed(2)}</span>`;
                cartItemsContainer.appendChild(itemDiv);
            });

            let shippingCost = 9.99;
            if (subtotal > 85.00) {
                shippingCost = 0.00;
                shippingCostElement.innerText = 'Free';
            } else {
                shippingCostElement.innerText = '€9.99';
            }

            const total = subtotal + shippingCost;
            totalCostElement.innerText = `€${total.toFixed(2)}`;
        }

        // Run on page load
        updateSummary();


    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank you for your order.</title>
    <link rel="shortcut icon" href="images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="shipping text-light text-center p-2" style="height: 30px;font-size: 12px">
        <p>Free Shipping on orders over €85</p><br>
    </div>

    <div class="banner hstack gap-3 text-bg-light">
        <div class="p-2"><i class="bi bi-search"></i></div>
        <div class="p-2 ms-auto">
            <h1 class="brand">
                <a href="index.php">
                    <img src="images/band-logo.png" alt="band logo" style="height: 200px; padding-top: 15px; margin-left: 50px">
                </a>
            </h1>
        </div>
        <div class="p-2 ms-auto d-flex align-items-center gap-2">
            <i class="bi bi-person"></i>
            <?php if (isset($_SESSION['user_email'])): ?>
                <span><?php echo ucfirst(explode('@', $_SESSION['username'])[0]); ?></span>
                <a href="user.php" class="btn btn-danger btn-sm me-3">Logout</a>
            <?php else: ?>
                <a href="user.php" class="btn btn-success btn-sm me-3">Log In</a>
            <?php endif; ?>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg bg-dark-subtle" data-bs-theme="dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="bi bi-list"></span>
            </button>
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

    <div class="container py-5">
        <h2 class="lacquer-regular">Order Successful!</h2>

        <?php
        // Check if cart session exists and has items
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])):
            $total_amount = 0;
        ?>

        <h4>Your Order Details:</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through cart session to display items
                foreach ($_SESSION['cart'] as $cart_item):
                    // Ensure the necessary fields exist and are not null
                    $product_name = isset($cart_item['name']) ? $cart_item['name'] : 'Unknown Product';
                    $quantity = isset($cart_item['quantity']) ? $cart_item['quantity'] : 0;
                    $price = isset($cart_item['price']) ? $cart_item['price'] : 0.00;
                    
                    $total_price = $quantity * $price;
                    $total_amount += $total_price;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($product_name); ?></td>
                    <td><?php echo $quantity; ?></td>
                    <td>€<?php echo number_format($price, 2); ?></td>
                    <td>€<?php echo number_format($total_price, 2); ?></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" class="text-end"><strong>Total Amount</strong></td>
                    <td><strong>€<?php echo number_format($total_amount, 2); ?></strong></td>
                </tr>
            </tbody>
        </table>

        <p>Thank you for shopping with us! We will process your order shortly.</p>

        <?php
        // Clear cart session after successful order (optional)
        unset($_SESSION['cart']);
        endif;
        ?>
    </div>
          <!-- Footer -->
  <footer class="py-4 bg-dark text-white text-center">
    <div class="container">
      <p>© 2024 Lunar Coast.</p>
      <div>
        <a href="#" class="text-white mx-2">Facebook</a>
        <a href="#" class="text-white mx-2">Instagram</a>
        <a href="#" class="text-white mx-2">Twitter</a>
      </div>
    </div>
  </footer> 
    <script src="js/trailingCursor.js"></script>
</body>

</html>

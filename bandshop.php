<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Lunar Coast Merchandise</title>
    <link rel="shortcut icon" href="images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/styles.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Lacquer&display=swap');
    </style>
</head>

<body>

<div class="shipping text-light text-center p-2" style="height: 30px; font-size: 12px">
    <p>Free Shipping on orders over €85</p>
</div>

<div class="banner hstack gap-3 text-bg-light">
    <div class="p-2"><i class="bi bi-search"></i></div>
    <div class="p-2 ms-auto">
        <h1 class="brand"><a href="index.php"><img src="images/band-logo.png" alt="band logo" style="height: 200px; padding-top: 15px; margin-left: 50px"></a>
    </div>
    <div class="p-2 ms-auto"><i class="bi bi-person"></i></div>
    <!-- Cart Icon -->
    <button class="btn" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas" aria-controls="cartOffcanvas">
        <i class="bi bi-bag"></i>
    </button>
</div>

<nav class="navbar navbar-expand-lg bg-dark-subtle" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="bi bi-list"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="bandshop.php">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tour.php">Tour</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about-the-band.php">The Band</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="songs.php">Songs</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="lacquer-regular">Filter Merchandise</h2>
    <div class="mb-3">
        <label for="merch_type" class="form-label">Select Merchandise Type:</label>
        <select id="merch_type" class="form-select">
            <option value="">All Merchandise</option>
            <option value="T-shirt">T-shirts</option>
            <option value="Hoodie">Hoodies</option>
            <option value="Mug">Mugs</option>
            <option value="Sticker">Stickers</option>
            <option value="Candle">Candles</option>
            <option value="Diary">Diary</option>
            <option value="Bottle">Bottles</option>
            <option value="Tote">Tote Bags</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="album_collection" class="form-label">Select Album Collection:</label>
        <select id="album_collection" class="form-select">
            <option value="">All Albums</option>
            <option value="Solstice">Solstice</option>
            <option value="AfterTheRain">After the Rain</option>
            <option value="Heartwood">Heartwood</option>
        </select>
    </div>
</div>

<!-- Shopping Cart Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel">
        <div class="offcanvas-header">
            <h3 class="offcanvas-title lacquer-regular" id="cartOffcanvasLabel">Shopping Cart</h3>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul id="cart-items" class="list-group">
                <!-- Cart items will appear here -->
            </ul>
            <div class="mt-3">
                <h6>Total: €<span id="cart-total">0.00</span></h6>
                <button class="btn btn-dark w-100" id="checkout">Checkout</button>
                <button id="clear-cart" class="btn btn-danger w-100 mt-3">Clear Cart</button>

            </div>
        </div>
    </div>

    <!-- Merchandise Cards -->
    <div class="container my-5">
        <h1 class="text-center mb-4 lacquer-regular">Shop Lunar Coast Merchandise</h1>
        <div id="merchandise-list" class="row g-4">
            <!-- Dynamic Merchandise Cards will appear here -->
        </div>
    </div>


    <!-- Footer -->
  <footer class="py-4 bg-dark text-white text-center">
    <div class="container">
      <p>© 2024 Lunar Coast. All rights reserved.</p>
      <div>
        <a href="#" class="text-white mx-2">Facebook</a>
        <a href="#" class="text-white mx-2">Instagram</a>
        <a href="#" class="text-white mx-2">Twitter</a>
      </div>
    </div>
  </footer>

<!-- JavaScript Files -->
<script src="js/fetch_merch.js"></script>
<script src="js/cart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>

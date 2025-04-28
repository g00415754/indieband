<?php
session_start();

// Database Connection
$conn = new mysqli('indieband', 'root', '', 'indieband_db');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lunar Coast</title>
  <link rel="shortcut icon" href="images/favicon.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Frijole&display=swap');


    .hero-section {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
    }

    .hero-section h1 {
      font-size: 4rem;
      text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
    }

    .hero-section p {
      font-size: 1.5rem;
      text-shadow: 1px 1px 6px rgba(0, 0, 0, 0.5);
    }

    footer a:hover {
      text-decoration: underline;
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

  <!-- Hero Section -->
  <header class="hero-section text-center text-white">
    <div class="container">
      <h1 class="display-3 frijole">Lunar Coast</h1>
      <p class="lead">Dreamy Sounds, Indie Vibes</p>
      <a href="tour.php" class="btn btn-dark btn-md">View Tour Dates</a>
    </div>
  </header>


  <!-- Awards Section -->
  <section id="awards" class="py-5 bg-light">
    <div class="container text-center">
      <h2 class="mb-4 frijole">Awards & Recognition</h2>
      <div class="row gap-2 justify-content-center">
        <div class="col-md-3 py-5 rounded">
          <i class="bi bi-music-note-beamed fs-1"></i>
          <h4>Best Indie Band 2023</h4>
          <p>Recognized at the Indie Music Awards.</p>
        </div>
        <div class="col-md-3 py-5 rounded">
          <i class="bi bi-award fs-1"></i>
          <h4>Top Album of the Year</h4>
          <p>"Coastal Dreams" ranked #1 on Indie Charts.</p>
        </div>
        <div class="col-md-3 py-5 rounded">
          <i class="bi bi-star fs-1"></i>
          <h4>Fan Choice Award</h4>
          <p>Voted by our amazing fans worldwide.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- About Us Section -->
  <section id="about" class="py-5">
    <div class="container">
      <h2 class="text-center mb-4 frijole">About Us</h2>
      <p class="text-center">Lunar Coast is a vibrant three-person indie girl band composed of Maya, Piper, and Ella.
        Together, they craft dreamy soundscapes infused with heartfelt lyrics, inspired by the rhythms of the ocean and
        the mysteries of the night sky. Since their inception, the band has captivated listeners with a unique blend of
        soulful vocals, atmospheric melodies, and an electric stage presence.
        <br><br>
        Their music is more than sound—it's a journey. Each track reflects the trio's shared experiences, personal
        growth, and the bond that fuels their creativity. From late-night songwriting sessions by the coast to
        performing at intimate venues, Lunar Coast's essence is a celebration of authenticity and connection.
      </p>
      <div class="row mt-4">
        <div class="col-md-6">
          <img src="images/aboutBand.jpg" alt="Lunar Coast Band" class="img-fluid ">
        </div>
        <div class="col-md-6"><br><br>
          <h3 class="frijole">Our Story</h3>
          <p>Lunar Coast was formed in 2016, when lifelong friends Maya, Piper, and Ella realized their shared passion
            for music was more than a hobby—it was a calling. The trio began crafting their sound in a makeshift studio
            by the beach, blending Maya's hauntingly beautiful vocals, Piper's captivating guitar riffs, and Ella's
            rhythmic drum beats into an ethereal, cohesive style.
            <br><br>
            Their debut album, Ocean Echoes, released in 2018, introduced listeners to their unique sound and earned
            them recognition on the indie music scene. Tracks like "Tides of You" and "Moonlit Skies" resonated deeply
            with fans, cementing their reputation as a band to watch.
            <br><br>
            As their journey progressed, Lunar Coast expanded their horizons, performing at iconic venues, collaborating
            with other artists, and garnering awards such as Best Indie Band 2023. Their music remains a testament to
            their friendship, creativity, and connection to the elements that inspire them.
            <br><br>
            With two more albums under their belt—Starlight Tides (2020) and Coastal Dreams (2022)—the band continues to
            evolve while staying true to their roots. Lunar Coast is not just a band; it's a shared dream brought to
            life, and they invite you to ride the waves of their music.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Albums Section -->
  <section id="albums" class="py-5">
    <div class="container text-center">
      <h2 class="mb-4 frijole">Our Albums</h2>
      <div class="row">
        <div class="col-md-4">
          <img src="album_covers_img/heartwood-cover.png" alt="Heartwood Album" class="img-fluid rounded mb-3">
          <h4>Heartwood</h4>
          <p>Released: 2018</p>
          <a href="songs.php" class="btn btn-dark">Listen Now</a>
        </div>
        <div class="col-md-4">
          <img src="album_covers_img/aftertherain-cover.png" alt="After the Rain Album" class="img-fluid rounded mb-3">
          <h4>After the Rain</h4>
          <p>Released: 2021</p>
          <a href="songs.php" class="btn btn-dark">Listen Now</a>
        </div>
        <div class="col-md-4">
          <img src="album_covers_img/solstice-cover.png" alt="Solstice Album" class="img-fluid rounded mb-3">
          <h4>Solstice</h4>
          <p>Released: 2024</p>
          <a href="songs.php" class="btn btn-dark">Listen Now</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Tour Section -->
  <div class="container my-4">
    <h1 class="frijole my-5">Upcoming Shows</h1>

    <?php
    $conn = new mysqli('localhost', 'root', 'root', 'indieband_db');
    if ($conn->connect_error) {
      die('Connection failed: ' . $conn->connect_error);
    }

    // Get the current date in YYYY-MM-DD format
    $today = date('Y-m-d');

    // Select the next 3 upcoming events by filtering out past dates
    // Fetch upcoming events using a prepared statement
    $sql = "SELECT event_id, event_name, event_date, venue, ticket_price 
    FROM Events 
    WHERE event_date >= ? 
    ORDER BY event_date 
    LIMIT 3";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $today); // Bind the date parameter
    $stmt->execute();
    $result = $stmt->get_result();


    $currentMonth = '';
    if ($result->num_rows > 0) {
      echo '<div class="tour-container">';

      while ($row = $result->fetch_assoc()) {
        $eventMonth = date('F', strtotime($row['event_date']));

        // Create a new month section if the month changes
        if ($eventMonth !== $currentMonth) {
          if ($currentMonth !== '') {
            echo '</div>'; // Close previous month's section
          }
          echo '<div class="month-section">';
          echo '<div class="month-title">' . $eventMonth . '</div>';
          $currentMonth = $eventMonth;
        }

        // Tour event card styling
        echo '<div class="event-pill">';
        echo '<div class="event-details">';
        echo '<div class="event-name">' . htmlspecialchars($row['event_name']) . '</div>';
        echo '<div>' . htmlspecialchars(date('M j, Y', strtotime($row['event_date']))) . '</div>';
        echo '<div> ' . htmlspecialchars($row['venue']) . '</div>';
        echo '<div> €' . number_format($row['ticket_price'], 2) . '</div>';
        echo '</div>';
        echo '<button class="btn btn-primary add-to-cart-btn">Tickets</button>';
        echo '</div>';
      }

      echo '</div>'; // Close last month's section
      echo '</div>'; // Close tour container
    } else {
      echo '<p class="text-center">No upcoming events available.</p>';
    }

    $conn->close();
    ?>


    <!-- Link to Full Tour Page -->
    <div class="text-center my-5">
      <a href="tour.php" class="btn btn-outline-dark">View All Tour Dates</a>
    </div>
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

  <div class="container my-4">
    <h2 class="frijole my-5">Featured Merchandise</h2>
    <div class="row">


      <?php
      $conn = new mysqli('localhost', 'root', 'root', 'indieband_db');
      if ($conn->connect_error) {
        die('<p class="text-center">Connection failed: ' . $conn->connect_error . '</p>');
      }

      // Fetch 4 random merchandise items using a prepared statement
      $sql = "SELECT item_id, name, description, price, item_image_ref FROM Merchandise ORDER BY RAND() LIMIT 4";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();


      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo '<div class="col-md-3">';
          echo '<div class="card">';
          echo '<img src="' . htmlspecialchars($row['item_image_ref']) . '" class="card-img-top" alt="' . htmlspecialchars($row['name']) . '">';
          echo '<div class="card-body">';
          echo '<h5 class="card-title">' . htmlspecialchars($row['name']) . '</h5>';
          echo '<p class="card-text">' . htmlspecialchars(substr($row['description'], 0, 100)) . '...</p>';
          echo '<p class="fw-bold">Price: €' . number_format($row['price'], 2) . '</p>';
          echo '<button class="btn btn-dark add-to-cart" data-item-id="' . $row['item_id'] . '" 
                data-item-name="' . htmlspecialchars($row['name']) . '" 
                data-item-price="' . $row['price'] . '" 
                data-item-image-ref="' . htmlspecialchars($row['item_image_ref']) . '" 
                data-bs-toggle="offcanvas" 
                data-bs-target="#cartOffcanvas">Add to Cart</button>';
        echo '</div></div></div>';
        }
      } else {
        echo '<p class="text-center">No merchandise available.</p>';
      }

      $conn->close();
      ?>

      <!-- Link to Full Merch Page -->
      <div class="text-center my-5">
        <a href="bandshop.php" class="btn btn-outline-dark">View All Merchandise</a>
      </div>
    </div>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

  <script src="js/cart.js"></script>
  <script src="js/trailingCursor.js"></script>
</body>

</html>

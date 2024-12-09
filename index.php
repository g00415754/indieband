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
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Lacquer&display=swap');
    </style>

  <style>
    /* Success message (green) */
    .success-msg {
      color: white;
      background-color: #198754;
      /* Green */
      padding: 15px;
      border-radius: 5px;
      margin-top: 10px;
    }

    /* Failure message (red) */
    .error-msg {
      color: white;
      background-color: #dc3545;
      /* Red */
      padding: 15px;
      border-radius: 5px;
      margin-top: 10px;
    }

    .hero-section {
      background: url('images/The Bullets.jpg') center/cover no-repeat;
      height: 85vh;
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
    <div class="p-2"><i class="bi bi-search"></i></div>
    <div class="p-2 ms-auto">
      <h1 class="brand"><a href="#"><img src="images/band-logo.png" alt="band logo"
            style="height: 200px; padding-top: 15px; margin-left: 50px"></a>
    </div>
    <div class="p-2 ms-auto">
      <!-- User Icon that triggers the modal -->
      <i class="bi bi-person" data-bs-toggle="modal" data-bs-target="#userModal"></i>
    </div>
    <div class="p-2"><i class="bi bi-bag"></i></div>
  </div>

  <nav class="navbar navbar-expand-lg bg-dark-subtle" data-bs-theme="dark">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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

  <!-- Modal for Login/SignUp -->
  <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="userModalLabel">Login / Sign Up</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Tab navigation for Login and Signup -->
          <ul class="nav nav-tabs" id="userTab" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" id="login-tab" data-bs-toggle="tab" href="#login" role="tab"
                aria-controls="login" aria-selected="true">Login</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="signup-tab" data-bs-toggle="tab" href="#signup" role="tab" aria-controls="signup"
                aria-selected="false">Sign Up</a>
            </li>
          </ul>
          <div class="tab-content mt-3" id="userTabContent">
            <!-- Login Form -->
            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
              <form id="loginForm">
                <div class="mb-3">
                  <label for="loginEmail" class="form-label">Email</label>
                  <input type="email" class="form-control" id="loginEmail" required>
                </div>
                <div class="mb-3">
                  <label for="loginPassword" class="form-label">Password</label>
                  <input type="password" class="form-control" id="loginPassword" required>
                </div>
                <button type="submit" class="btn btn-dark">Login</button>
              </form>
              <!-- Success/Failure Message for Login -->
              <div id="loginMessage" class="mt-3" style="display:none;"></div>
            </div>

            <!-- Sign Up Form -->
            <div class="tab-pane fade" id="signup" role="tabpanel" aria-labelledby="signup-tab">
              <form id="signupForm">
                <div class="mb-3">
                  <label for="signupUsername" class="form-label">Username</label>
                  <input type="text" class="form-control" id="signupUsername" required>
                </div>
                <div class="mb-3">
                  <label for="signupEmail" class="form-label">Email</label>
                  <input type="email" class="form-control" id="signupEmail" required>
                </div>
                <div class="mb-3">
                  <label for="signupPassword" class="form-label">Password</label>
                  <input type="password" class="form-control" id="signupPassword" required>
                </div>
                <button type="submit" class="btn btn-dark">Sign Up</button>
              </form>
              <!-- Success/Failure Message for Sign Up -->
              <div id="signupMessage" class="mt-3" style="display:none;"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  </div>


  <!-- Hero Section -->
  <header class="hero-section text-center text-white">
    <div class="container">
      <h1 class="display-3 lacquer-regular">Lunar Coast</h1>
      <p class="lead">Dreamy Sounds, Indie Vibes</p>
      <a href="tour.php" class="btn btn-dark btn-md">View Tour Dates</a>
    </div>
  </header>

  <!-- Awards Section -->
  <section id="awards" class="py-5 bg-light">
    <div class="container text-center">
      <h2 class="mb-4 lacquer-regular">Awards & Recognition</h2>
      <div class="row">
        <div class="col-md-4">
          <i class="bi bi-music-note-beamed fs-1"></i>
          <h4>Best Indie Band 2023</h4>
          <p>Recognized at the Indie Music Awards.</p>
        </div>
        <div class="col-md-4">
          <i class="bi bi-award fs-1"></i>
          <h4>Top Album of the Year</h4>
          <p>"Coastal Dreams" ranked #1 on Indie Charts.</p>
        </div>
        <div class="col-md-4">
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
      <h2 class="text-center mb-4 lacquer-regular">About Us</h2>
      <p class="text-center">Lunar Coast is a vibrant three-person indie girl band composed of Maya, Piper, and Ella. Together, they craft dreamy soundscapes infused with heartfelt lyrics, inspired by the rhythms of the ocean and the mysteries of the night sky. Since their inception, the band has captivated listeners with a unique blend of soulful vocals, atmospheric melodies, and an electric stage presence.
<br><br>
Their music is more than sound—it's a journey. Each track reflects the trio's shared experiences, personal growth, and the bond that fuels their creativity. From late-night songwriting sessions by the coast to performing at intimate venues, Lunar Coast's essence is a celebration of authenticity and connection.</p>
      <div class="row mt-4">
        <div class="col-md-6">
          <img src="images/aboutBand.jpg" alt="Lunar Coast Band" class="img-fluid">
        </div>
        <div class="col-md-6"><br><br>
          <h3 class="lacquer-regular">Our Story</h3>
          <p>Lunar Coast was formed in 2016, when lifelong friends Maya, Piper, and Ella realized their shared passion for music was more than a hobby—it was a calling. The trio began crafting their sound in a makeshift studio by the beach, blending Maya's hauntingly beautiful vocals, Piper's captivating guitar riffs, and Ella's rhythmic drum beats into an ethereal, cohesive style.
<br><br>
Their debut album, Ocean Echoes, released in 2018, introduced listeners to their unique sound and earned them recognition on the indie music scene. Tracks like "Tides of You" and "Moonlit Skies" resonated deeply with fans, cementing their reputation as a band to watch.
<br><br>
As their journey progressed, Lunar Coast expanded their horizons, performing at iconic venues, collaborating with other artists, and garnering awards such as Best Indie Band 2023. Their music remains a testament to their friendship, creativity, and connection to the elements that inspire them.
<br><br>
With two more albums under their belt—Starlight Tides (2020) and Coastal Dreams (2022)—the band continues to evolve while staying true to their roots. Lunar Coast is not just a band; it's a shared dream brought to life, and they invite you to ride the waves of their music.</p>
        </div>
      </div>
    </div>
  </section>

    <!-- Albums Section -->
    <section id="albums" class="py-5 bg-light">
        <div class="container text-center">
            <h2 class="mb-4 lacquer-regular">Our Albums</h2>
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
  <section id="tour" class="py-5 bg-light">
    <div class="container text-center">
      <h2 class="mb-4 lacquer-regular">Tour Dates</h2>
        <a href="tour.php" class="btn btn-dark">Discover tour dates near you!</a>
    </div>
  </section>

  <!-- Shop Section -->
  <section id="shop" class="py-5">
    <div class="container text-center">
      <h2 class="mb-4 lacquer-regular">Shop Merchandise</h2>
        <a href="bandshop.php" class="btn btn-dark">Apperal and Music!</a>
    </div>
  </section>

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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

  <script src="js/user_account.js"></script>
</body>

</html>
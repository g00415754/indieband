<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lunar Coast: Music Discography</title>
    <link rel="shortcut icon" href="images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/styles.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Lacquer&display=swap');
    </style>
</head>

<body>
    <?php
    session_start();
    ?>

    <div class="shipping text-light text-center p-2" style="height: 30px;font-size: 12px">
        <p>Free Shipping on orders over €85</p>
    </div>

    <div class="banner hstack gap-3 text-bg-light">
        <div class="p-2"><i class="bi bi-search"></i></div>

        <div class="p-2 ms-auto">
            <h1 class="brand">
                <a href="index.php">
                    <img src="images/band-logo.png" alt="band logo"
                        style="height: 200px; padding-top: 15px; margin-left: 50px">
                </a>
            </h1>
        </div>

        <div class="p-2 ms-auto d-flex align-items-center gap-2">
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

        <div class="p-2"><i class="bi bi-bag"></i></div>
    </div>

    <nav class="navbar navbar-expand-lg bg-dark-subtle" data-bs-theme="dark">
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

    <?php
    // Database connection
$conn = new mysqli('indieband', 'root', '', 'indieband_db');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Fetch distinct albums for dropdown
    $albumQuery = "SELECT DISTINCT album FROM Songs ORDER BY album";
    $albumStmt = $conn->prepare($albumQuery);
    $albumStmt->execute();
    $albumsResult = $albumStmt->get_result();

    // Fetch distinct genres for dropdown
    $genreQuery = "SELECT DISTINCT genre FROM Songs ORDER BY genre";
    $genreStmt = $conn->prepare($genreQuery);
    $genreStmt->execute();
    $genresResult = $genreStmt->get_result();


    $conn->close();
    ?>

    <div class="container my-4">
        <h1 class="lacquer-regular">Search Music Discography</h1><br>
        <form id="filter_form">
            <label for="album_select">Filter by Album:</label>
            <select id="album_select" name="album" onchange="updateSongList()" class="btn dropdown-toggle" type="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                <option value="" selected>All Albums</option>
                <?php while ($row = $albumsResult->fetch_assoc()): ?>
                    <option value="<?= htmlspecialchars($row['album']) ?>"><?= htmlspecialchars($row['album']) ?></option>
                <?php endwhile; ?>
            </select>
            <label for="genre_select">Filter by Genre:</label>
            <select id="genre_select" name="genre" onchange="updateSongList()" class="btn dropdown-toggle" type="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                <option value="" selected>All Genres</option>
                <?php while ($row = $genresResult->fetch_assoc()): ?>
                    <option value="<?= htmlspecialchars($row['genre']) ?>"><?= htmlspecialchars($row['genre']) ?></option>
                <?php endwhile; ?>
            </select>
        </form><br>

        <div id="songs_table">
            <!-- Songs table will be dynamically loaded here -->
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="streamModal" tabindex="-1" aria-labelledby="streamModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="streamModalLabel">Thank you for Downloading!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    You've successfully downloaded <span id="songName"></span>!
                </div><br><br>
            </div>
        </div>
    </div>

    <script>
        function updateSongList() {
            const formData = new FormData(document.getElementById('filter_form'));

            fetch('fetchSongs.php', {
                method: 'POST',
                body: formData,
            })
                .then(response => {
                    if (response.ok) {
                        return response.text();
                    }
                    throw new Error('Network response was not ok.');
                })
                .then(data => {
                    document.getElementById('songs_table').innerHTML = data;
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }

        // Load all songs on page load
        document.addEventListener('DOMContentLoaded', updateSongList);
    </script>

    <script>
        // Function to trigger the modal and display the song name
        function showStreamModal(songName) {
            // Set the song name in the modal
            document.getElementById('songName').textContent = songName;

            // Show the modal using Bootstrap's Modal constructor
            var myModal = new bootstrap.Modal(document.getElementById('streamModal'));
            myModal.show();
        }
    </script>



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
    <script src="js/trailingCursor.js"></script>
</body>

</html>

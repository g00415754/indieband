<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lunar Coast - Tour</title>
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
        <p>Free Shipping on orders over €85</p><br>
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




    <div class="container my-4">
        <h1 class="lacquer-regular">Find a Tour Date Near You</h1>
        <?php
        $conn = new mysqli('localhost', 'root', 'root', 'indieband_db');
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        // Fetch all events ordered by event date using a prepared statement
        $sql = "SELECT event_id, event_name, event_date, venue, ticket_price FROM Events ORDER BY event_date";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();


        $currentMonth = '';
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $eventMonth = date('F', strtotime($row['event_date']));

                if ($eventMonth !== $currentMonth) {
                    if ($currentMonth !== '') {
                        echo '</div>'; // Close previous month's section
                    }
                    echo '<div class="month-section">';
                    echo '<div class="month-title">' . $eventMonth . '</div>';
                    $currentMonth = $eventMonth;
                }

                echo '<div class="event-pill">';
                echo '<div class="event-details">';
                echo '<div class="event-name">' . htmlspecialchars($row['event_name']) . '</div>';
                echo '<div>' . htmlspecialchars(date('M j, Y', strtotime($row['event_date']))) . '</div>';
                echo '<div> ' . htmlspecialchars($row['venue']) . '</div>';
                echo '<div> €' . number_format($row['ticket_price'], 2) . '</div>';
                echo '</div>';
                echo '<button class="btn add-to-cart-btn">Tickets</button>';
                echo '</div>';
            }
            echo '</div>'; // Close the last month's section
        } else {
            echo '<p class="text-center">No events available.</p>';
        }
        $conn->close();
        ?>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="js/trailingCursor.js"></script>

</body>

</html>
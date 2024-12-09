<?php
// Database connection
$conn = new mysqli('indieband', 'root', '', 'indieband_db');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Retrieve filter parameters
$album = isset($_POST['album']) ? htmlspecialchars($_POST['album']) : '';
$genre = isset($_POST['genre']) ? htmlspecialchars($_POST['genre']) : '';

// Build SQL query
$sql = "SELECT * FROM Songs WHERE 1=1";
if (!empty($album)) {
    $sql .= " AND album = '" . $conn->real_escape_string($album) . "'";
}
if (!empty($genre)) {
    $sql .= " AND genre = '" . $conn->real_escape_string($genre) . "'";
}

$sql .= " ORDER BY release_year DESC";

$result = $conn->query($sql);

// Generate the table with the song list
$songList = '';
if ($result->num_rows > 0) {
    $songList .= "<div class='table-responsive'>";
    $songList .= "<table class='table table-striped table-hover align-middle'>";
    $songList .= "<thead class='table-dark'>";
    $songList .= "<tr><th>Song Name</th><th>Album</th><th></th><th>Genre</th><th>Release Year</th><th></th></tr>";
    $songList .= "</thead><tbody>";

    while ($row = $result->fetch_assoc()) {
        $songTitle = isset($row['title']) ? htmlspecialchars($row['title']) : 'Unknown Song';
        $albumName = isset($row['album']) ? htmlspecialchars($row['album']) : 'Unknown Album';
        $genre = isset($row['genre']) ? htmlspecialchars($row['genre']) : 'Unknown Genre';
        $releaseYear = isset($row['release_year']) ? htmlspecialchars($row['release_year']) : 'Unknown Year';
        $albumImage = isset($row['album_image_ref']) ? htmlspecialchars($row['album_image_ref']) : '';

        $songList .= "<tr>";
        $songList .= "<td>" . $songTitle . "</td>";
        $songList .= "<td>" . $albumName . "</td>";

        // Display the album image in its own column if available
        if (!empty($albumImage)) {
            $songList .= "<td><img src='$albumImage' alt='Album Image' style='width: 50px; height: 50px;'></td>";
        } else {
            $songList .= "<td>No Image</td>";
        }

        $songList .= "<td>" . $genre . "</td>";
        $songList .= "<td>" . $releaseYear . "</td>";
        $songList .= "<td><button class='btn btn-dark' onclick='showStreamModal(\"$songTitle\")'>Download</button></td>";
        $songList .= "</tr>";
    }

    $songList .= "</tbody></table>";
    $songList .= "</div>";
} else {
    $songList = "<p>No songs found matching the criteria.</p>";
}

echo $songList;

$conn->close();
?>

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
    // Function to trigger the modal and display the song name
    function showStreamModal(songName) {
        // Set the song name in the modal
        document.getElementById('songName').textContent = songName;
        
        // Show the modal using Bootstrap's Modal constructor
        var myModal = new bootstrap.Modal(document.getElementById('streamModal'));
        myModal.show();
    }
</script>

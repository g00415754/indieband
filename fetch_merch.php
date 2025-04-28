<?php
// Database connection
$conn = new mysqli("localhost", "root", "root", "indieband_db");

if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed']));
}

// Decode JSON input
$data = json_decode(file_get_contents('php://input'), true);
$merch_type = $data['merch_type'] ?? '';
$album_collection = $data['album_collection'] ?? '';

// Base query
$sql = "SELECT item_id, name, description, price, item_image_ref FROM Merchandise";

// Logic for filtering by merch_type
if ($merch_type && $merch_type !== 'All Merchandise') {
    $sql .= " WHERE name LIKE '%$merch_type%'";
} 

// Logic for filtering by album_collection
if ($album_collection) {
    if (strpos($sql, 'WHERE') === false) {
        $sql .= " WHERE name LIKE '%$album_collection%'";
    } else {
        $sql .= " AND name LIKE '%$album_collection%'";
    }
}

// Execute query
$result = $conn->query($sql);

// Fetch data and encode as JSON
$items = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}

echo json_encode($items);

// Close connection
$conn->close();
?>
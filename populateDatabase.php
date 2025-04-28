<!DOCTYPE html>
<html>

<head>
    <title>Populating Database Table</title>
</head>

<body>

    <?php
    $servername = "localhost"; // Correct server
    $username = "root"; // Default username for MAMP
    $password = "root"; // Default password for MAMP
    $dbname = "indieband_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO Band_Members (name, role, bio, join_date, image_ref) VALUES
('Maya Quinn', 'Vocals, Guitar', 'Maya is the heart and soul of the band, with her captivating vocals and dynamic guitar playing. Her music blends folk and indie rock influences with a personal touch.', '2018-03-15', 'band_members_img/maya.jpg'),
('Ella Carter', 'Vocals, Guitar', 'Ellas harmonies complement Maya perfectly, with her exceptional guitar work creating layers of sound that give the band a unique blend of acoustic and electric elements.', '2018-03-15', 'band_members_img/ella.jpg'),
('Piper Hill', 'Vocals, Drums', 'Piper brings an infectious energy to the band with her powerful drumming and emotive vocals. She drives the rhythm while adding a distinct flavor with her vocal contributions.', '2018-03-15', 'band_members_img/piper.jpg');
";
    if ($conn->query($sql) === TRUE) {
        echo "Table entries created successfully<br>";
    } else {
        echo "Error creating table: " . $conn->error;
    }


    $sql = "INSERT INTO Events (event_name, event_date, venue, ticket_price) VALUES
('Lollapalooza Festival', '2024-12-01 16:00:00', 'Grant Park, Chicago', 85.00),
('Glastonbury Festival', '2024-12-05 18:00:00', 'Glastonbury, UK', 85.00),
('Coachella Valley Music and Arts Festival', '2025-04-10 17:00:00', 'Empire Polo Club, California', 85.00),
('Rock am Ring Festival', '2025-06-05 20:00:00', 'Nürburgring, Germany', 85.00),
('Madison Square Garden Concert', '2025-02-20 19:00:00', 'Madison Square Garden, New York', 85.00),
('Tokyo Dome Live Performance', '2025-03-01 21:00:00', 'Tokyo Dome, Japan', 85.00),
('Wembley Stadium Concert', '2025-06-15 20:30:00', 'Wembley Stadium, London', 85.00),
('The O2 Arena Show', '2025-07-10 19:00:00', 'The O2 Arena, London', 85.00),
('Primavera Sound Festival', '2025-05-25 17:00:00', 'Parc del Fòrum, Barcelona', 85.00),
('Sziget Festival', '2025-08-07 19:00:00', 'Óbuda Island, Budapest', 85.00),
('Rock in Rio Festival', '2025-09-15 18:00:00', 'Parque Olímpico, Rio de Janeiro', 85.00),
('Accor Arena Concert', '2025-04-22 20:00:00', 'Accor Arena, Paris', 85.00),
('Download Festival', '2025-06-01 18:30:00', 'Donington Park, UK', 85.00),
('Maracanã Stadium Performance', '2025-07-05 21:30:00', 'Maracanã Stadium, Rio de Janeiro', 85.00),
('La Patinoire de Bercy Event', '2025-08-15 20:00:00', 'La Patinoire de Bercy, Paris', 85.00),
('Ziggodome Concert', '2025-05-30 19:00:00', 'Ziggodome, Amsterdam', 85.00);";

    if ($conn->query($sql) === TRUE) {
        echo "Events added successfully<br>";
    } else {
        echo "Error adding events: " . $conn->error;
    }

    $sql = "INSERT INTO Songs (title, album, genre, release_year, album_image_ref) VALUES

('Whispers in the Trees', 'Heartwood', 'Indie Rock', 2018, 'album_covers_img/heartwood-cover.png'),
('Shattered Dreams', 'Heartwood', 'Indie Folk', 2018, 'album_covers_img/heartwood-cover.png'),
('Faded Light', 'Heartwood', 'Indie Pop', 2018, 'album_covers_img/heartwood-cover.png'),
('Timeless Echo', 'Heartwood', 'Indie Rock', 2018, 'album_covers_img/heartwood-cover.png'),
('Underneath the Stars', 'Heartwood', 'Indie Folk', 2018, 'album_covers_img/heartwood-cover.png'),
('Beneath the Surface', 'Heartwood', 'Indie Rock', 2018, 'album_covers_img/heartwood-cover.png'),
('Golden Horizon', 'Heartwood', 'Indie Pop', 2018, 'album_covers_img/heartwood-cover.png'),
('Broken Wings', 'Heartwood', 'Indie Rock', 2018, 'album_covers_img/heartwood-cover.png'),
('Fallen Leaves', 'Heartwood', 'Indie Folk', 2018, 'album_covers_img/heartwood-cover.png'),
('Echo of Silence', 'Heartwood', 'Indie Pop', 2018, 'album_covers_img/heartwood-cover.png'),
('The Last Light', 'Heartwood', 'Indie Rock', 2018, 'album_covers_img/heartwood-cover.png'),
('Silent Forest', 'Heartwood', 'Indie Folk', 2018, 'album_covers_img/heartwood-cover.png'),
('Heart of Stone', 'Heartwood', 'Indie Rock', 2018, 'album_covers_img/heartwood-cover.png'),
('Starlit Path', 'Heartwood', 'Indie Pop', 2018, 'album_covers_img/heartwood-cover.png'),
('Fading Memories', 'Heartwood', 'Indie Folk', 2018, 'album_covers_img/heartwood-cover.png'),
('Eternal Flame', 'Heartwood', 'Indie Pop', 2018, 'album_covers_img/heartwood-cover.png'),
('Wildflower', 'Heartwood', 'Indie Rock', 2018, 'album_covers_img/heartwood-cover.png'),
('Rising Dawn', 'Heartwood', 'Indie Pop', 2018, 'album_covers_img/heartwood-cover.png'),
('Into the Night', 'Heartwood', 'Indie Rock', 2018, 'album_covers_img/heartwood-cover.png'),


('After the Rain', 'After the Rain', 'Indie Pop', 2021, 'album_covers_img/aftertherain-cover.png'),
('Echoes of the Past', 'After the Rain', 'Indie Rock', 2021, 'album_covers_img/aftertherain-cover.png'),
('Dancing in the Storm', 'After the Rain', 'Indie Pop', 2021, 'album_covers_img/aftertherain-cover.png'),
('The Broken Road', 'After the Rain', 'Indie Folk', 2021, 'album_covers_img/aftertherain-cover.png'),
('When the Sky Falls', 'After the Rain', 'Indie Rock', 2021, 'album_covers_img/aftertherain-cover.png'),
('Shadow of the Moon', 'After the Rain', 'Indie Folk', 2021, 'album_covers_img/aftertherain-cover.png'),
('Soft as Rain', 'After the Rain', 'Indie Pop', 2021, 'album_covers_img/aftertherain-cover.png'),
('Through the Clouds', 'After the Rain', 'Indie Rock', 2021, 'album_covers_img/aftertherain-cover.png'),
('Into the Horizon', 'After the Rain', 'Indie Folk', 2021, 'album_covers_img/aftertherain-cover.png'),
('Riverside Dreams', 'After the Rain', 'Indie Pop', 2021, 'album_covers_img/aftertherain-cover.png'),
('A Moment of Silence', 'After the Rain', 'Indie Rock', 2021, 'album_covers_img/aftertherain-cover.png'),
('Chasing the Wind', 'After the Rain', 'Indie Folk', 2021, 'album_covers_img/aftertherain-cover.png'),
('Lost in Time', 'After the Rain', 'Indie Pop', 2021, 'album_covers_img/aftertherain-cover.png'),
('Burning Skies', 'After the Rain', 'Indie Rock', 2021, 'album_covers_img/aftertherain-cover.png'),
('The Night You Left', 'After the Rain', 'Indie Folk', 2021, 'album_covers_img/aftertherain-cover.png'),
('When the Sun Rises', 'After the Rain', 'Indie Pop', 2021, 'album_covers_img/aftertherain-cover.png'),
('Voices in the Rain', 'After the Rain', 'Indie Rock', 2021, 'album_covers_img/aftertherain-cover.png'),
('Silver Linings', 'After the Rain', 'Indie Folk', 2021, 'album_covers_img/aftertherain-cover.png'),
('Chasing Stars', 'After the Rain', 'Indie Pop', 2021, 'album_covers_img/aftertherain-cover.png'),
('Shining Through', 'After the Rain', 'Indie Rock', 2021, 'album_covers_img/aftertherain-cover.png'),


('Solstice', 'Solstice', 'Indie Folk', 2024, 'album_covers_img/solstice-cover.png'),
('Into the Fire', 'Solstice', 'Indie Rock', 2024, 'album_covers_img/solstice-cover.png'),
('Northern Lights', 'Solstice', 'Indie Pop', 2024, 'album_covers_img/solstice-cover.png'),
('Frostbitten Heart', 'Solstice', 'Indie Folk', 2024, 'album_covers_img/solstice-cover.png'),
('Twilight Shadows', 'Solstice', 'Indie Rock', 2024, 'album_covers_img/solstice-cover.png'),
('Fire and Ice', 'Solstice', 'Indie Pop', 2024, 'album_covers_img/solstice-cover.png'),
('Echoes in the Snow', 'Solstice', 'Indie Folk', 2024, 'album_covers_img/solstice-cover.png'),
('Winds of Winter', 'Solstice', 'Indie Rock', 2024, 'album_covers_img/solstice-cover.png'),
('Afterglow', 'Solstice', 'Indie Pop', 2024, 'album_covers_img/solstice-cover.png'),
('Moonlit Dreams', 'Solstice', 'Indie Folk', 2024, 'album_covers_img/solstice-cover.png'),
('Frozen Tears', 'Solstice', 'Indie Rock', 2024, 'album_covers_img/solstice-cover.png'),
('Winter', 'Solstice', 'Indie Pop', 2024, 'album_covers_img/solstice-cover.png'),
('Starlit Sky', 'Solstice', 'Indie Folk', 2024, 'album_covers_img/solstice-cover.png'),
('Chasing the Solstice', 'Solstice', 'Indie Rock', 2024, 'album_covers_img/solstice-cover.png'),
('Northern Star', 'Solstice', 'Indie Pop', 2024, 'album_covers_img/solstice-cover.png'),
('Wolves in the Night', 'Solstice', 'Indie Folk', 2024, 'album_covers_img/solstice-cover.png'),
('Under the Ice', 'Solstice', 'Indie Rock', 2024, 'album_covers_img/solstice-cover.png'),
('Endless Winter', 'Solstice', 'Indie Pop', 2024, 'album_covers_img/solstice-cover.png'),
('Lost in the Cold', 'Solstice', 'Indie Folk', 2024, 'album_covers_img/solstice-cover.png'),
('Through the Storm', 'Solstice', 'Indie Rock', 2024, 'album_covers_img/solstice-cover.png');
";

if ($conn->query($sql) === TRUE) {
    echo "Songs added successfully<br>";
} else {
    echo "Error adding events: " . $conn->error;
}


$sql = "INSERT INTO Merchandise (name, description, price, stock, item_image_ref) VALUES

('After the Rain Plastic Bottle', 'After the Rain album cover printed on an eco-friendly plastic bottle.', 25.00, 100, 'merchandise_img/aftertherain-bottle.png'),
('After the Rain CD', 'After the Rain album on CD.', 15.00, 500, 'merchandise_img/aftertherain-cd.png'),
('After the Rain Diary', 'After the Rain album cover printed on a 200 page diary.', 30.00, 70, 'merchandise_img/aftertherain-diary.png'),
('After the Rain Hoodie', 'After the Rain album cover printed on an eco-friendly 100% cotton hoodie.', 65.00, 200, 'merchandise_img/aftertherain-hoodie.png'),
('After the Rain Laptop Sticker', 'After the Rain album cover laptop sticker.', 5.00, 100, 'merchandise_img/aftertherain-sticker.png'),
('After the Rain Standard T-Shirt', 'After the Rain album cover printed on an eco-friendly 100% cotton t-shirt.', 25.00, 100, 'merchandise_img/aftertherain-tee.png'),
('After the Rain Vinyl', 'After the Rain album vinyl pressed in black and green.', 45.00, 300, 'merchandise_img/aftertherain-vinyl.png'),

('Lunar Coast Band Logo T-shirt', 'T-shirt with band logo on front.', 30.00, 100, 'merchandise_img/band-logo-t-shirt.png'),
('Heartwood Back Design T-shirt', 'Heartwood album cover printed on the back of an eco-frindly 100% cotton t-shirt.', 45.00, 90, 'merchandise_img/heartwood-back-tee.png'),
('Heartwood Plastic Bottle', 'Heartwood album cover printed on an eco-friendly plastic bottle.', 25.00, 90, 'merchandise_img/heartwood-bottle.png'),
('Heartwood Candle', 'Heartwood album cover printed on a candle.', 15.00, 30, 'merchandise_img/heartwood-candle.png'),
('Heartwood CD', 'Heartwood album on CD.', 15.00, 90, 'merchandise_img/heartwood-cd.png'),
('Heartwood Diary', 'Heartwood album cover printed on a 200 page diary.', 30.00, 90, 'merchandise_img/heartwood-diary.png'),
('Heartwood Hoodie', 'Heartwood album cover printed on an eco-friendly 100% cotton hoodie.', 65.00, 90, 'merchandise_img/heartwood-front-hoodie.png'),
('Heartwood Longsleeve Shirt', 'Heartwood album cover printed on an eco-friendly 100% cotton longsleeve shirt.', 45.00, 40, 'merchandise_img/heartwood-longsleeve.png'),
('Heartwood Standard T-shirt', 'Heartwood album cover printed on an eco-friendly 100% cotton t-shirt.', 25.00, 90, 'merchandise_img/Heartwood-Tee.png'),
('Heartwood Totebag', 'Heartwood album cover printed on an eco-friendly 100% cotton tote bag.', 20.00, 90, 'merchandise_img/heartwood-totebag.png'),
('Heartwood Vinyl', 'Heartwood album pressed on standard black vinyl.', 45.00, 200, 'merchandise_img/heartwood-vinyl.png'),
('Lunar Coast x After the Rain T-Shirt', 'Band logo printed on 100% cotton t-shirt with After the Rain album cover.', 25.00, 90, 'merchandise_img/logo-and-aftertherain-tee.png'),
('Lunar Coast Back Logo T-shirt', 'Band logo printed on back of 100% cotton t-shirt.', 25.00, 90, 'merchandise_img/logo-back-tee.mp4'),
('Lunar Coast Logo Bottle', 'Band logo printed on plastic bottle.', 20.00, 90, 'merchandise_img/logo-bottle.png'),
('Lunar Coast Cap', 'Band logo printed on baseball cap.', 25.00, 90, 'merchandise_img/logo-cap.png'),
('Lunar Coast Coaster (Set of 4)', 'Band logo printed on 4 coasters.', 15.00, 40, 'merchandise_img/logo-coaster.png'),
('Lunar Coast Green Hoodie', 'Band logo printed on an eco-friendly 100% cotton green hoodie.', 45.00, 90, 'merchandise_img/logo-hoodie-green.png'),
('Lunar Coast Laptop Sticker', 'Band logo printed on a laptop sticker.', 5.00, 60, 'merchandise_img/logo-sticker.png'),

('Solstice Hoodie', 'Solstice album cover printed on eco-friendly 100% cotton hoodie.', 55.00, 90, 'merchandise_img/solstice-back-hoodie.png'),
('Solstice Cap', 'Solstice album cover printed on eco-friendly 100% cotton cap.', 25.00, 90, 'merchandise_img/solstice-cap.png'),
('Solstice CD', 'Solstice album CD.', 15.00, 200, 'merchandise_img/solstice-cd.png'),
('Solstice Coffee Cup', 'Solstice album cover printed on a coffee cup.', 25.00, 110, 'merchandise_img/solstice-coffeecup.png'),
('Solstice Mug', 'Solstice album cover printed on ceramic mug.', 25.00, 90, 'merchandise_img/solstice-mug.png'),
('Solstice Vinyl', 'Solstice album Vinyl pressed in black and green.', 45.00, 300, 'merchandise_img/solstice-vinyl.png');
";
if ($conn->query($sql) === TRUE) {
    echo "Merch added successfully<br>";
} else {
    echo "Error adding events: " . $conn->error;
}


$conn->close();
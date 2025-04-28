<!DOCTYPE html>
<html>

<head>
    <title>Creating Database Table</title>
</head>

<body>

    <?php
    $servername = "localhost"; // Correct server
    $username = "root"; // Default username for MAMP
    $password = "root"; // Default password for MAMP
    $dbname = "indieband_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create database
    $sql = "CREATE DATABASE $dbname;";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully<br>";
    } else {
        echo "Error creating database: " . $conn->error;
    }

    $conn->close();  // Close the first connection
    
    // Reconnect to the database
    $conn = new mysqli("localhost", "root", "root", $dbname); // Correct connection
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // sql to create Users table
    $sql = "CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;";
    if ($conn->query($sql) === TRUE) {
        echo "Users table created successfully<br>";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    // sql to create Band_Members table
    $sql = "CREATE TABLE Band_Members (
    member_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    role VARCHAR(100),
    bio TEXT,
    join_date DATE,
    image_ref VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;";
    if ($conn->query($sql) === TRUE) {
        echo "Band members table created successfully<br>";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    // sql to create Events table
    $sql = "CREATE TABLE Events (
    event_id INT AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(100) NOT NULL,
    event_date DATETIME NOT NULL,
    venue VARCHAR(100) NOT NULL,
    ticket_price DECIMAL(10, 2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;";
    if ($conn->query($sql) === TRUE) {
        echo "Events table created successfully<br>";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    // sql to create Merchandise table
    $sql = "CREATE TABLE Merchandise (
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL,
    item_image_ref VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;";
    if ($conn->query($sql) === TRUE) {
        echo "Merchandise table created successfully<br>";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    // sql to create Songs table
    $sql = "CREATE TABLE Songs (
    song_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    album VARCHAR(100),
    genre VARCHAR(50),
    release_year YEAR,
    album_image_ref VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;";
    if ($conn->query($sql) === TRUE) {
        echo "Songs table created successfully<br>";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    // sql to create Orders table
    $sql = "CREATE TABLE Orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE
) ENGINE=InnoDB;";
    if ($conn->query($sql) === TRUE) {
        echo "Orders table created successfully<br>";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    // sql to create Order_Items table
    $sql = "CREATE TABLE Order_Items (
    order_item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    item_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2),
    FOREIGN KEY (order_id) REFERENCES Orders(order_id) ON DELETE CASCADE,
    FOREIGN KEY (item_id) REFERENCES Merchandise(item_id) ON DELETE CASCADE
) ENGINE=InnoDB;";
    if ($conn->query($sql) === TRUE) {
        echo "Order items table created successfully<br>";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    $conn->close();  // Close connection
    ?>



</body>

</html>
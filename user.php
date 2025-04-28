<?php
// Check if the session is already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Database Connection
$conn = new mysqli('localhost', 'root', 'root', 'indieband_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize the $loginMessage variable
$loginMessage = "";

// Check if the user is logged in
if (isset($_SESSION['user_email'])) {
    $loginMessage = "Hello!"; 
} else {
    $loginMessage = "Please log in.";
}

// Handle Signup
$signupMessage = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signup"])) {
    // Check if POST data is set
    if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
        $username = ucfirst($_POST['username']); // Capitalize the first letter
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

        // Check if either the email or the username already exists
        $stmt = $conn->prepare("SELECT user_id, email, username FROM users WHERE email=? OR username=?");
        $stmt->bind_param("ss", $email, $username); // Two parameters: email and username
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($userId, $existingEmail, $existingUsername);
            $stmt->fetch();

            // Check which field is already taken and give appropriate message
            if ($existingEmail == $email) {
                $signupMessage = "Email is already registered.";
            } else if ($existingUsername == $username) {
                $signupMessage = "Username is already registered.";
            }
        } else {
            // Proceed with insertion if both email and username are unique
            $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $password); // Three parameters: username, email, password
            if ($stmt->execute()) {
                $signupMessage = "Signup successful! You can now log in.";
            } else {
                $signupMessage = "Signup failed: " . $stmt->error;
            }
        }
        $stmt->close();
    } else {
        $signupMessage = "Please provide username, email, and password.";
    }
}



// Handle Login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {

    // Check if POST data is set
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare and execute the query to fetch user data (including username)
        $stmt = $conn->prepare("SELECT user_id, email, password_hash, username FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($userId, $userEmail, $hashedPassword, $username);
        $stmt->fetch();
        $stmt->close();

        if ($hashedPassword && password_verify($password, $hashedPassword)) {
            // Set session variables for user data
            $_SESSION['user_id'] = $userId;
            $_SESSION['user_email'] = $userEmail;
            $_SESSION['username'] = $username;  // Store the username in session

            // Handle "Remember Me"
            if (isset($_POST['remember'])) {
                setcookie('remembered_email', $email, time() + (30 * 24 * 60 * 60), "/"); // 30 days
            } else {
                setcookie('remembered_email', '', time() - 3600, "/"); // Expire immediately
            }

            // Redirect to index page after successful login
            header("Location: index.php");
            exit();

        } else {
            $loginMessage = "Invalid email or password.";
        }
    } else {
        $loginMessage = "Please provide both email and password.";
    }


}



$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body class="d-flex mt-5">

    <div class="container mt-5">
        <h2 class="text-center">Login / Sign Up</h2><br><br>

        <div class="row align-items-center justify-content-center">
            <!-- SIGNUP FORM (flipped to left) -->
            <div class="col-md-5">
                <div class="card p-4">
                    <h4>Sign Up</h4>
                    <form method="POST">
                        <input type="hidden" name="signup">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-dark w-100">Sign Up</button>
                    </form>
                    <?php if ($signupMessage): ?>
                        <div class="alert alert-info mt-3 text-center"><?php echo $signupMessage; ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- "OR" Text -->
            <div class="col-md-1 text-center">
                <h5>OR</h5>
            </div>

            <!-- LOGIN FORM (flipped to right) -->
            <div class="col-md-5">
                <div class="card p-4">
                    <h4>Login</h4>
                    <form method="POST">
                        <input type="hidden" name="login">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required
                                value="<?php echo isset($_COOKIE['remembered_email']) ? $_COOKIE['remembered_email'] : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>

                        <div class="mb-3">
                            <input type="checkbox" name="remember" id="remember-me" <?php if (isset($_COOKIE['remembered_email']))
                                echo 'checked'; ?>>
                            <label for="remember-me">Remember Me</label>
                        </div>



                        <button type="submit" class="btn btn-dark w-100">Login</button>
                    </form>
                    <?php if ($loginMessage): ?>
                        <div class="alert alert-info mt-3 text-center"><?php echo $loginMessage; ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="js/trailingCursor.js"></script>
</body>

</html>
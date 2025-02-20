<?php
// Start session to track user login status
session_start();

// Database connection
$servername = "localhost";
$username = "root";  // Your MySQL username
$password = "";      // Your MySQL password
$dbname = "dance_ai_db";  // Your MySQL database name
$port = 3307; // MySQL default port, change if needed

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getTheme() {
    global $conn;  // Access the global $conn variable
    if (isset($_SESSION['username'])) {
        $user_id = $_SESSION['user_id'];
        $themeQuery = "SELECT theme FROM user_settings WHERE user_id = $user_id";
        $themeResult = $conn->query($themeQuery);
        if ($themeResult->num_rows > 0) {
            $row = $themeResult->fetch_assoc();
            return $row['theme'];
        } else {
            return 1;  // Default theme if no result found
        }
    } else {
        return 1;  // Default theme if user not logged in
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php
    $setTheme = getTheme();
    if($setTheme == 1){
        echo ' <link href="css/styleLight.css" rel="stylesheet"> ';
    }
    elseif ($setTheme == 2){
        echo ' <link href="css/styleDark.css" rel="stylesheet"> ';
    }
    ?>
</head>
<body>
    <?php include 'navbar.php'; ?> <!-- Ensuring navbar format matches index.php -->
    
    <div class="container">
        <h1 class="text-center">Submit Your Feedback</h1>
        
        <div class="feedback-box">
            <!-- Feedback Form -->
            <form action="submit_feedback.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Feedback:</label>
                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Upload an Image (optional):</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

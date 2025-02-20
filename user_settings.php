<?php
session_start(); // Start the session to track user login status

// Database connection variables
$servername = "localhost";  // MySQL server (usually localhost)
$username = "root";         // MySQL username (default root for XAMPP)
$password = "";       // MySQL password (you've set this as "ics311")
$dbname = "dance_ai_db";    // Your actual database name
$port = 3307;               // Assuming this is your MySQL port for XAMPP, usually 3306 but you mentioned 3307

// Create the connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the user settings
$user_id = $_SESSION['user_id'];
$sql = "SELECT theme, email_blog, email_events, email_dance FROM user_settings WHERE user_id = $user_id";
$result = $conn->query($sql);

$checkbox_states = [];
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $theme = $row['theme'];
    $checkbox_states['BlogCheck'] = $row['email_blog'];
    $checkbox_states['EventsCheck'] = $row['email_events'];
    $checkbox_states['DanceCheck'] = $row['email_dance'];
}

function isChecked($id, $checkbox_states) {
    return isset($checkbox_states[$id]) && $checkbox_states[$id] ? 'checked' : '';
}

function isSelected($optionValue, $theme) {
    return $optionValue == $theme ? 'selected' : '';
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

// Include the navbar (which already contains session_start())
include('navbar.php');
?>

<!-- Add Favicon -->
<link rel="icon" href="favicon.ico" type="image/x-icon">

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dance USA - Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
<div class="modal fade" role="dialog" tabindex="-1" id="modal-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirm Account Delete</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body"><button class="btn btn-danger" type="button">Confirm Account Delete</button></div>
            <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button></div>
        </div>
    </div>
</div>
<div class="container mt-4 mb-4">
    <h1>User Settings</h1>
</div>
<form>
    <div class="container mt-4 mb-4">
        <h2 style="text-shadow: 1px 1px;">Website Theme Preference</h2><select class="form-select" style="width: 200px;">
            <optgroup label="Themes">
                <option value="1" <?php echo isSelected(1, $theme); ?>>Light</option>
                <option value="2" <?php echo isSelected(2, $theme); ?>>Dark</option>
                <option value="3" <?php echo isSelected(3, $theme); ?>>Green</option>
                <option value="4" <?php echo isSelected(4, $theme); ?>>Blue</option>
            </optgroup>
        </select>
    </div>
    <div class="container mt-4 mb-4">
        <h2 style="text-shadow: 1px 1px;">Email Preferences</h2>
        <div class="form-check"><input class="form-check-input" type="checkbox" id="BlogCheck" <?php echo isChecked('BlogCheck', $checkbox_states); ?>><label class="form-check-label" for="BlogCheck">Blog Posts</label></div>
        <div class="form-check"><input class="form-check-input" type="checkbox" id="EventsCheck" <?php echo isChecked('EventsCheck', $checkbox_states); ?>><label class="form-check-label" for="EventsCheck">Events</label></div>
        <div class="form-check"><input class="form-check-input" type="checkbox" id="DanceCheck" <?php echo isChecked('DanceCheck', $checkbox_states); ?>><label class="form-check-label" for="DanceCheck">New Dances</label></div>
    </div>
    <div class="container mt-4 mb-4">
        <h2 style="text-shadow: 1px 1px;">Account Settings</h2>
        <div><input class="form-control mb-2" type="password" name="User_New_Password" placeholder="New Password" style="width: 200px;"></div>
        <div><input class="form-control" type="password" name="User_Old_Password" placeholder="Old Password" style="width: 200px;"></div>
    </div>
    <div class="container"><button class="btn btn-primary" type="submit">Update Preferences</button></div>
</form>
<div class="container mt-5"><button class="btn btn-danger" type="button" data-bs-target="#modal-1" data-bs-toggle="modal">Delete Account</button></div>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/Simple-Slider-swiper-bundle.min.js"></script>
<script src="assets/js/Simple-Slider.js"></script>
</body>

</html>

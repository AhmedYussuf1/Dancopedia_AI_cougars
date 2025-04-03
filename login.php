<?php
session_start();

// Database connection
include('db_connection.php');

// Handle POST request for login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape the input values to prevent SQL Injection
    $user_username = $conn->real_escape_string(trim($_POST['username']));
    $user_password = trim($_POST['password']);

    // Prepare SQL query to get user info (check by username)
    $stmt = $conn->prepare("SELECT user_id, username, password_hash, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $user_username);  // "s" means it's a string
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $username, $password_hash, $role);

    // Check if user exists and password is correct
    if ($stmt->fetch()) {
        // Password verification using password_verify()
        if (password_verify($user_password, $password_hash)) {
            // Password is correct, set session variables
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;  // Store user role (user/admin)

            // Redirect to index.php after successful login
            header("Location: index.php");  // Redirect to index.php (home page)
            exit();  // Exit after redirect
        } else {
            // Invalid password
            $_SESSION['message'] = "Invalid password!";
            header("Location: error.php");
            exit();
        }
    } else {
        // No user found with that username
        $_SESSION['message'] = "No user found with that username!";
        header("Location: error.php");
        exit();
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dance USA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Include Navbar -->
<?php include('navbar.php'); ?>

<div class="container">
    <h2 class="my-5 text-center">Login</h2>

    <!-- Display error message if there is one -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>

    <!-- Login form -->
    <form method="POST" action="login.php">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <!-- Forgot Password Link -->
    <div class="mt-3 text-center">
        <a href="forgot_password.php" class="btn btn-link">Forgot Password?</a>
    </div>

    <!-- Register Button -->
    <div class="mt-3 text-center">
        <a href="register.php" class="btn btn-secondary">Register</a>
    </div>

    <!-- If logged in, show Logout button -->
    <?php if (isset($_SESSION['username'])): ?>
        <div class="mt-3 text-center">
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    <?php endif; ?>

    <!-- Admin button (only show if the user is an admin) -->
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <div class="mt-3 text-center">
            <a href="admin_dashboard.php" class="btn btn-warning">Admin Dashboard</a>
        </div>
    <?php endif; ?>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

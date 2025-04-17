<?php
ob_start();
session_start();
// Database connection
include('db_connection.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['token'])) {
    $token = $_GET['token'];
} else {
    // Token is not found in the URL, handle error
    $_SESSION['message'] = "Invalid or missing token.";
    header("Location: forgot_password.php");
    exit();
}

if (isset($token)) {
    // Check if the token is valid
    $stmt = $conn->prepare("SELECT email, expires FROM password_resets WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($email, $expires);

    if ($stmt->fetch()) {
        // Token is valid, check if it has expired
        if (time() > $expires) {
            $_SESSION['message'] = "The password reset link has expired.";
            header("Location: forgot_password.php");
            exit();
        }

        // Handle POST request for resetting password
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $new_password = trim($_POST['password']);
            $password_hash = password_hash($new_password, PASSWORD_BCRYPT);

            // Update the password in the database
            $stmt = $conn->prepare("UPDATE users SET password_hash = ? WHERE email = ?");
            $stmt->bind_param("ss", $password_hash, $email);
            $stmt->execute();

            // Delete the reset token from the database
            $stmt = $conn->prepare("DELETE FROM password_resets WHERE token = ?");
            $stmt->bind_param("s", $token);
            $stmt->execute();

            $_SESSION['message'] = "Your password has been successfully reset.";
            header("Location: login.php");  // Redirect to login page
            exit();
        }
    } else {
        $_SESSION['message'] = "Invalid token.";
        header("Location: forgot_password.php");
        exit();
    }

    $stmt->close();
}

$conn->close();
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Dance USA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Include Navbar -->
<?php include('navbar.php'); ?>

<div class="container">
    <h2 class="my-5 text-center">Reset Password</h2>

    <!-- Display error message if there is one -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-info" role="alert">
            <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>

    <!-- Reset password form -->
    <form method="POST" action="reset_password.php?token=<?php echo htmlspecialchars($token); ?>">
        <div class="mb-3">
            <label for="password" class="form-label">Enter your new password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>

    <div class="mt-3 text-center">
        <a href="login.php" class="btn btn-secondary">Back to Login</a>
    </div>

</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
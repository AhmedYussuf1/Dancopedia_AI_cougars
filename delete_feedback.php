<?php
include('db_connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM feedback WHERE id = ?");
    $stmt->bind_param("i", $id);

    $stmt->execute();
    
    $stmt->close();
    $conn->close();
}

// Redirect back to the admin dashboard after deletion
header("Location: admin_dashboard.php");
exit();
?>

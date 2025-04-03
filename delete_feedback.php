<?php
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM feedback WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo 'Error: ' . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo 'Invalid request.';
}
?>

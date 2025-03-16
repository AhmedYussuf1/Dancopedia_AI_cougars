<?php
// Start session
session_start();

// Include database connection
include('db_connection.php');

// Get the search query
$searchQuery = isset($_GET['query']) ? trim($_GET['query']) : '';

// Prepare the SQL query
$sql = "SELECT * FROM dances WHERE name LIKE ? OR description LIKE ?";
$stmt = $conn->prepare($sql);

// Use wildcards for partial matches
$searchTerm = "%$searchQuery%";
$stmt->bind_param("ss", $searchTerm, $searchTerm);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Display the results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-4 mb-4">';
        echo '    <div class="card">';
        echo '        <h5 class="card-title">' . htmlspecialchars($row['name']) . '</h5>';
        echo '        <p>' . htmlspecialchars($row['description']) . '</p>';
        echo '    </div>';
        echo '</div>';
    }
} else {
    echo '<p class="text-center">No results found for: "' . htmlspecialchars($searchQuery) . '"</p>';
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>





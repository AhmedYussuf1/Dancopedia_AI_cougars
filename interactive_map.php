<!DOCTYPE html>
<html lang="en">
<head>
<?php 
// Start session to track user login status
session_start();

// Database connection
include('db_connection.php');

// Query to get dance data
$sql = "SELECT * FROM dances";  // Ensure this matches your table and column names
$result = $conn->query($sql);
 
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

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Dance Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script> 
    
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/styleDark.css">
    <style>
        body {
           
    
        }
        #map { 
            height: 700px; width: 98%;
            margin: 0 auto;
            margin-top: 20px;
         }
        .popup-content img, .popup-content video { width: 200px; height: auto; }
    </style>
</head>
<body>
     
    <?php include('navbar.php'); ?>

 
    <div id="map"></div>

    <script>
        // Initialize the map
        var map = L.map('map').setView([20, 0], 2); // World view

        // Load OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var usaBounds = [
            [18.91, -179.14], // Southwest corner (covers Hawaii and the westernmost part of Alaska)
            [71.39, -66.93]   // Northeast corner (covers northern Alaska and Maine)
        ];

        // Function to fetch coordinates from city name using Nominatim API
        async function getCoordinates(city) {
            let url = `https://nominatim.openstreetmap.org/search?format=json&q=${city}`;
            let response = await fetch(url);
            let data = await response.json();
            return data.length > 0 ? [parseFloat(data[0].lat), parseFloat(data[0].lon)] : null;
        }

        // Load marker data from PHP
        fetch("get_markers.php")
            .then(response => response.json())
            .then(async data => {
                for (const marker of data) {
                    let coords = await getCoordinates(marker.city);
                    if (coords) {
                        var popupContent = `
                            <div class="popup-content">
                                ${marker.type === "video" ? 
                                    `<video controls><source src="${marker.media}" type="video/mp4"></video>` : 
                                    `<img src="${marker.media}" alt="Dance Image">`
                                }
                                <br>
                                <a href="${marker.link}" target="_blank">View Dance</a>
                            </div>
                        `;

                        L.marker(coords).addTo(map).bindPopup(popupContent);
                    } else {
                        console.error("Could not find coordinates for:", marker.city);
                    }
                }
            })
            .catch(error => console.error("Error loading markers:", error));
    </script>
</body>
</html>

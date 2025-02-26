<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
    session_start();
    include('db_connection.php');

    function getTheme() {
        global $conn;
        if (isset($_SESSION['username'])) {
            $user_id = $_SESSION['user_id'];
            $query = "SELECT theme FROM user_settings WHERE user_id = $user_id";
            $result = $conn->query($query);
            return ($result->num_rows > 0) ? $result->fetch_assoc()['theme'] : 1;
        }
        return 1;
    }
    
    $theme = getTheme();
    ?>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dance USA - Home</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Theme CSS -->
    <link href="css/style<?= $theme == 2 ? 'Dark' : 'Light' ?>.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/navbar.css">
    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script> 
    
    <style>
        #map { 
            height: 700px; 
            width: 98%;
            margin: 20px auto;
        }
        .popup-content img, .popup-content video {
            width: 200px; 
            height: auto;
        }
    </style>
</head>
<body>
    <?php include('navbar.php'); ?>
    
    <div id="map"></div>
    
    <script>
        var map = L.map('map').setView([20, 0], 2);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

       // Function to fetch coordinates from city name using Nominatim API with caching
async function getCoordinates(city) {
    let cacheKey = `coords_${city}`;
    let cachedData = localStorage.getItem(cacheKey);

    if (cachedData) {
        return JSON.parse(cachedData);
    }

    let url = `https://nominatim.openstreetmap.org/search?format=json&q=${city}`;
    
    try {
        let response = await fetch(url);
        let data = await response.json();

        if (data.length > 0) {
            let coords = [parseFloat(data[0].lat), parseFloat(data[0].lon)];
            localStorage.setItem(cacheKey, JSON.stringify(coords)); // Cache the result
            return coords;
        } else {
            console.warn(`No coordinates found for: ${city}`);
            return null;
        }
    } catch (error) {
        console.error("Error fetching coordinates:", error);
        return null;
    }
}


        fetch("get_markers.php")
            .then(response => response.json())
            .then(async data => {
                for (const marker of data) {
                    let coords = await getCoordinates(marker.city);
                    if (coords) {
                        let popupContent = `
                            <div class="popup-content">
                                ${marker.type === "video" ? 
                                    `<video controls><source src="${marker.media}" type="video/mp4"></video>` : 
                                    `<img src="${marker.media}" alt="Dance Image">
                                    '<`
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

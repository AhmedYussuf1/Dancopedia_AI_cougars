<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    session_start();
    require_once 'db_connection.php';
    include('navbar.php');
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dance USA - Home</title>
      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Favicon -->
       <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />

    <!-- Theme -->
    <?php include('getTheme.php'); ?>

    <style>
        #map {
            width: 98%;
            margin: 20px auto;
            min-height: 700px;
            height: 100%;
        }
        .popup-content img, .popup-content video {
            width: 200px;
            height: auto;
        }
    </style>
</head>
<body>

    <div id="map"></div>

    <!-- Leaflet + Cluster Scripts -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Helper to extract YouTube ID
        function getYouTubeID(url) {
            let match = url.match(/(?:youtu\.be\/|youtube\.com\/(?:.*v=|.*\/))([\w-]{11})/);
            return match ? match[1] : null;
        }

        // Map initialization
        const map = L.map('map').setView([37.0902, -95.7129], 4);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        const usaBounds = [
            [18.91, -179.14],
            [71.39, -66.93]
        ];
        map.setMaxBounds(usaBounds);
        map.setMaxZoom(8);
        map.setZoom(5);
        map.setMinZoom(4);

        map.on('drag', () => map.panInsideBounds(usaBounds, { animate: false }));
/*****************************************************************************************************
* Fetch coordinates for a city using Nominatim API and cache them in localStorage.
 * @param {string} city - The name of the city to fetch coordinates for.
 * @returns {Promise<Array<number>>} - A promise that resolves to an array of [latitude, longitude].
 * Fetch coordinates for a city using Nominatim API and cache them in localStorage.
* @param {string} city - The name of the city to fetch coordinates for.
* @returns {Promise<Array<number>>} - A promise that resolves to an array of [latitude, longitude].
* @throws {Error} - Throws an error if the city is not found or if the API request fails.
 **********************************************************************************************************/
     
        async function getCoordinates(city) {
            const cacheKey = `coords_${city}`;
            const cached = localStorage.getItem(cacheKey);
            if (cached) return JSON.parse(cached);

            const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${city}`);
            const data = await response.json();

            if (data.length > 0) {
                const coords = [parseFloat(data[0].lat), parseFloat(data[0].lon)];
                localStorage.setItem(cacheKey, JSON.stringify(coords));
                return coords;
            } else {
                console.warn(`No coordinates found for city: ${city}`);
                return null;
            }
        }
 /******************************************************************************
*   Fetch dance markers from the database and add them to the map.
*   @param {string} city - The name of the PHP to get the dance data 
* The ffunction gets dance data and adds markers to the map.
*   @catch {Error} - Catches any errors that occur during the fetch process.

*****************************************************************************/

        fetch("get_markers.php")
            .then(res => res.json())
            .then(async data => {
                const markerCluster = L.markerClusterGroup(
                );

                for (const marker of data) {
                    const coords = await getCoordinates(marker.city);
                    if (!coords) continue;

                    const mediaElement = marker.type === "video"
                        ? (marker.media.includes("youtube.com") || marker.media.includes("youtu.be")
                            ? `<iframe width="100%" height="215" src="https://www.youtube.com/embed/${getYouTubeID(marker.media)}" frameborder="0" allowfullscreen></iframe>`
                            : `<video class="card-img-top" controls><source src="${marker.media}" type="video/mp4"></video>`)
                        : `<img class="card-img-top" src="${marker.media}" alt="Dance Image">`;

                    const popupContent = `
                        <div class="card" style="width: 18rem;">
                            ${mediaElement}
                            <div class="card-body">
                                <h5 class="card-title">${marker.genre}</h5>
                                <p class="card-text">${marker.city}</p>
                                <p class="card-text">${marker.description}</p>
                                <a href="dance_view.php?video_id=${marker.id}">
                                    <button type="button" class="btn btn-dark mt-2">View Dance</button>
                                </a>
                            </div>
                        </div>
                    `;

                    const mapMarker = L.marker(coords).bindPopup(popupContent);
                    markerCluster.addLayer(mapMarker);
                }

                map.addLayer(markerCluster);
            })
            .catch(err => console.error("Error fetching markers:", err));
    </script>

    <?php include('footer.php'); ?>
</body>
</html>

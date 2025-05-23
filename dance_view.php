<?php
include('navbar.php');
// Database connection
include('db_connection.php');

function getVideoLink($conn){
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['video_id'])) {
        $videoId = $_GET['video_id'];
        if($_GET['video_id'] != "undefined") {
            $sql = "SELECT video_url FROM dances WHERE dance_id = $videoId";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $videoURL = $row["video_url"];
                preg_match('/(?:youtube\.com\/(?:[^\/\n\s]+\/[^\n\s]+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $videoURL, $matches);
                $videoID = $matches[1]; // YouTube video ID
                return "https://www.youtube.com/embed/$videoID";
            } else {
                echo 'No video ID found.';
            }
        } else {
            echo 'No video ID provided.';
        }
    } else {
        echo 'No video ID provided.';
    }
}

function getDescription($conn){
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['video_id'])) {
        $videoId = $_GET['video_id'];
        if($videoId != "undefined") {
            $sql = "SELECT description FROM dances WHERE dance_id = $videoId";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row["description"];
            } else {
                echo 'No Video Found';
            }
        } else {
            echo 'No video ID provided.';
        }
    } else {
        echo 'No video ID provided.';
    }
}

function getRegion($conn){
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['video_id'])) {
        $videoId = $_GET['video_id'];
        if($videoId != "undefined") {
            $sql = "SELECT region FROM dances WHERE dance_id = $videoId";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row["region"];
            } else {
                echo 'No Video Found';
            }
        } else {
            echo 'No video ID provided.';
        }
    } else {
        echo 'No video ID provided.';
    }
}

function getTitle($conn){
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['video_id'])) {
        $videoId = $_GET['video_id'];
        if($videoId != "undefined") {
            $sql = "SELECT name FROM dances WHERE dance_id = $videoId";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row["name"];
            } else {
                echo 'No Video Found';
            }
        } else {
            echo 'No video ID provided.';
        }
    } else {
        echo 'No Video Found';
    }
}

function getGenre($conn){
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['video_id'])) {
        $videoId = $_GET['video_id'];
        if($videoId != "undefined") {
            $sql = "SELECT genre FROM dances WHERE dance_id = $videoId";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row["genre"];
            } else {
                echo 'No Video Found';
            }
        } else {
            echo 'No video ID provided.';
        }
    } else {
        echo 'No video ID provided.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viewing <?php echo getTitle($conn); ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php include('getTheme.php'); ?>
</head>
<body>

<!-- Title Section -->
<div class="container my-4 text-center text-decoration-underline">
    <h1><?php echo getTitle($conn); ?></h1>
</div>

<!-- Responsive Video Embed -->
<div class="container mb-4">
    <div class="ratio ratio-16x9">
        <iframe src="<?php echo getVideoLink($conn); ?>"
                title="Video Player"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
    </div>
</div>

<!-- Info Section -->
<div class="container my-4 border border-5 border-dark rounded-5 p-4">
    <div class="text-center mb-3">
        <h1>Genre:</h1>
        <p class="fs-3"><?php echo getGenre($conn); ?></p>
    </div>

    <div class="text-center mb-3">
        <h1>Region:</h1>
        <p class="fs-3"><?php echo getRegion($conn); ?></p>
    </div>

    <div class="text-center">
        <h1>Description:</h1>
        <p class="fs-3"><?php echo getDescription($conn); ?></p>
    </div>
</div>

<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
<?php include('footer.php'); ?>
</html>

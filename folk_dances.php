<?php
session_start();
// Include the navbar (which already contains session_start())
include('navbar.php');
// Database connection
include('db_connection.php');
include('getTheme.php');
 // Query to get  from dance table with genre name Classical
 $sql = "SELECT * FROM `dances` WHERE  genre='Hiphop'";  // Ensure this matches your table and column names
 $result = $conn->query($sql);

 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>American Folk Dances</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- exacted css style for folk_dance.php -->
    <link rel="stylesheet" href="css/folk_dance.css">
    < 
     
   
</head>
<body>

   
    <!-- //display the dance data in a card format -->
    <div class="container main-content">
        <header class="text-center my-5">
            <h1 class="display-3">American Folk Dances</h1>
            <p class="lead">Discover the unique and vibrant folk dance traditions from across the United States.</p>
        </header>
        <div class="row">
            <!-- Square Dance -->
            <?php

            if ($result->num_rows > 0) {
                // output data of each row
               
                while($row = $result->fetch_assoc()) {
                    
                    $videoURL = $row['video_url']; // Assuming your database has a column for video URLs
                    $videoName = $row['name']; // Video name
                    $videoGenre = $row['genre']; // Genre
                    $videoRegion = $row['region']; // Region

                    // Extract YouTube video ID from URL
                    preg_match('/(?:youtube\.com\/(?:[^\/\n\s]+\/[^\n\s]+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $videoURL, $matches);
                    $videoID = $matches[1]; // YouTube video ID

                    echo '    <div class="col-md-4 d-flex">
                <div class="card dance-card">
                  <iframe width="100%" height="215" src="https://www.youtube.com/embed/' . $videoID . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <div class="card-body dance-card-body">
                        <h5 class="card-title
                        ">' . $row['name'] . '</h5>
                        <p class="card-text">Genre: ' . $row['genre'] . '</p>
                        <p class="card-text">Region: ' . $row['region'] . '</p>
                        <p class="card-text">Description: ' . $row['description'] . '</p>
                   
                    </div>
                </div>
            </div>';
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </div>
    </div>          
  <?php
    include('footer.php');
    ?>
         

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>

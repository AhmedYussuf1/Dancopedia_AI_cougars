<?php
 

 function displayDanceCard($result) {
   
   
echo $sql;
 
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
    };
    
}

?>
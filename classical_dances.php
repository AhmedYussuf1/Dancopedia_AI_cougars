<?php
session_start();
// Include the navbar (which already contains session_start())
include('navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classical Dances</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .main-content {
            margin-top: 30px;
        }

        .dance-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background-color: #fff;
        }

        .dance-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .dance-card-body {
            padding: 20px;
        }

        .dance-card-body h5 {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .footer {
            background-color: #343a40;
            color: white;
            padding: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Classical Dances Content -->
    <div class="container main-content">
        <header class="text-center my-5">
            <h1 class="display-3">Classical American Dances</h1>
            <p class="lead">Explore the rich tradition of classical dance forms from the United States.</p>
        </header>

        <div class="row">
            <!-- Native American Dance -->
            <div class="col-md-4">
                <div class="card dance-card">
                    <img src="images/native_american_dance.jpg" alt="Native American Dance">
                    <div class="card-body dance-card-body">
                        <h5 class="card-title">Native American Dance</h5>
                        <p class="card-text">
                            Native American dances are deeply rooted in spiritual and cultural practices. These dances are performed during ceremonies, festivals, and communal gatherings. The movements are expressive and symbolic, reflecting the connection to nature and ancestral traditions.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Swing Dance -->
            <div class="col-md-4">
                <div class="card dance-card">
                    <img src="images/swing_dance.jpg" alt="Swing Dance">
                    <div class="card-body dance-card-body">
                        <h5 class="card-title">Swing Dance</h5>
                        <p class="card-text">
                            Swing dance emerged in the early 20th century, particularly in Harlem, New York, during the Jazz Age. Known for its lively and energetic movements, swing dance includes variations such as the Lindy Hop, Charleston, and Jitterbug, all performed to upbeat jazz music.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Modern Dance -->
            <div class="col-md-4">
                <div class="card dance-card">
                    <img src="images/modern_dance.jpg" alt="Modern Dance">
                    <div class="card-body dance-card-body">
                        <h5 class="card-title">Modern Dance</h5>
                        <p class="card-text">
                            Modern dance, which emerged in the early 20th century, broke away from the traditional constraints of ballet. Pioneers like Martha Graham and Merce Cunningham used modern dance to express emotions and tell stories through experimental movements.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Jazz Dance -->
            <div class="col-md-4">
                <div class="card dance-card">
                    <img src="images/jazz_dance.jpg" alt="Jazz Dance">
                    <div class="card-body dance-card-body">
                        <h5 class="card-title">Jazz Dance</h5>
                        <p class="card-text">
                            Originating in African American communities, jazz dance blends rhythmic, energetic movements with improvisation. It gained mainstream popularity in the early 20th century, heavily influencing Broadway musicals and modern pop dance styles.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Tap Dance -->
            <div class="col-md-4">
                <div class="card dance-card">
                    <img src="images/tap_dance.jpg" alt="Tap Dance">
                    <div class="card-body dance-card-body">
                        <h5 class="card-title">Tap Dance</h5>
                        <p class="card-text">
                            Tap dance originated in the early 19th century, combining African rhythms and Irish clog dancing. Known for its unique sound created by tapping metal plates on shoes, tap dance was made famous by stars like Fred Astaire and Gene Kelly in the 20th century.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Clogging -->
            <div class="col-md-4">
                <div class="card dance-card">
                    <img src="images/clogging.jpg" alt="Clogging">
                    <div class="card-body dance-card-body">
                        <h5 class="card-title">Clogging</h5>
                        <p class="card-text">
                            Clogging is a folk dance from the Appalachian region of the United States. It blends Irish, Scottish, and African dance styles, characterized by percussive footwork and rhythm. It is often performed to bluegrass or country music.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>

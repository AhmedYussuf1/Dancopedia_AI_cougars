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
    <title>American Folk Dances</title>
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

    <!-- American Folk Dances Content -->
    <div class="container main-content">
        <header class="text-center my-5">
            <h1 class="display-3">American Folk Dances</h1>
            <p class="lead">Discover the unique and vibrant folk dance traditions from across the United States.</p>
        </header>

        <div class="row">
            <!-- Square Dance -->
            <div class="col-md-4">
                <div class="card dance-card">
                    <img src="images/folk/square_dance.jpg" alt="Square Dance">
                    <div class="card-body dance-card-body">
                        <h5 class="card-title">Square Dance</h5>
                        <p class="card-text">
                            Square dance is a lively American folk dance, usually involving four couples arranged in a square. It is traditionally performed to folk music and is known for its choreographed steps and patterns.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Appalachian Clog Dance -->
            <div class="col-md-4">
                <div class="card dance-card">
                    <img src="images/folk/appalachian_clog.jpg" alt="Appalachian Clog Dance">
                    <div class="card-body dance-card-body">
                        <h5 class="card-title">Appalachian Clog Dance</h5>
                        <p class="card-text">
                            The Appalachian clog dance is a high-energy percussive dance style from the Appalachian region. It combines rhythmic foot stomping and fast movements, often performed to old-time and bluegrass music.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Cajun Dance -->
            <div class="col-md-4">
                <div class="card dance-card">
                    <img src="images/folk/cajun_dance.jpg" alt="Cajun Dance">
                    <div class="card-body dance-card-body">
                        <h5 class="card-title">Cajun Dance</h5>
                        <p class="card-text">
                            Cajun dance is a lively and intimate dance style from the southern Louisiana region. It’s typically done to Cajun or Zydeco music and features close partner dancing with fast-paced footwork and twirls.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Contra Dance -->
            <div class="col-md-4">
                <div class="card dance-card">
                    <img src="images/folk/contra_dance.jpg" alt="Contra Dance">
                    <div class="card-body dance-card-body">
                        <h5 class="card-title">Contra Dance</h5>
                        <p class="card-text">
                            Contra dance is a social folk dance where couples dance in two facing lines. This American tradition features lively, simple, and easy-to-follow steps, often danced to live folk music.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Native American Powwow Dance -->
            <div class="col-md-4">
                <div class="card dance-card">
                    <img src="images/folk/powwow_dance.jpg" alt="Native American Powwow Dance">
                    <div class="card-body dance-card-body">
                        <h5 class="card-title">Native American Powwow Dance</h5>
                        <p class="card-text">
                            Powwow dancing is a traditional dance performed during Native American powwows. Each style represents different tribes and traditions, including the graceful Grass Dance and powerful Men's Traditional Dance.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Texas Two-Step -->
            <div class="col-md-4">
                <div class="card dance-card">
                    <img src="images/folk/texas_two_step.jpg" alt="Texas Two-Step">
                    <div class="card-body dance-card-body">
                        <h5 class="card-title">Texas Two-Step</h5>
                        <p class="card-text">
                            The Texas Two-Step is a popular partner dance that originated in Texas and is commonly danced to country-western music. It consists of quick steps and smooth movements and is a staple in country dance halls.
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

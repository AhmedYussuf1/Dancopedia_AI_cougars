

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classical Dances</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php
    session_start();
    require_once('utility_functions/display_result.php');
    
    // Include the navbar (which already contains session_start())
    include('navbar.php');
    // Database connection
    include('db_connection.php');
    include('getTheme.php');
    // Query to get  from dance table with genre name Classical
    $sql = "SELECT * FROM `dances` WHERE  genre='class' or genre='Class' or genre='Classical'   ";  // Ensure this matches your table and column names
    $result = $conn->query($sql);

?>
    <style>
        /* Custom Styles */
        body {
            font-family: 'Arial', sans-serif;
        }

        .main-content {
            margin-top: 30px;
            
        }

        .dance-card {
            border: 1px;
            border-radius: 8px;
            overflow: hidden;
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
    </style>
</head>
<body>

   
    <!-- Blank Screen for Classical Dances Page -->
    <div class="  container main-content  ">
        <header class="text-center my-5""></header>  
        <h2 class="display-3">Classical Dances</h2>
        <p class="lead">This page will contain information about classical dances in the future.</p>

    
  
        <div class="row">
            <!-- Square Dance -->
            <?php
            // Display dance cards
            displayDanceCard($result);
       
            
        $conn->close();
        ?>
        </div>
    </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Search function
        function searchDances() {
            let query = document.getElementById('search-bar').value;
            if (query) {
                alert('Searching for: ' + query);
                // Implement real search logic or redirect
            } else {
                alert('Please enter a search query.');
            }
        }
    </script>
    <?php
    // Include the footer content
   displayDanceCard($result);
    include('footer.php');
    ?>
</body>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</html>
          

 
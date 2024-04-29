<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JetSetGo!</title>
    <link rel="icon" type="image/x-icon" href="../images/faviconPlane.svg">
    <link rel="stylesheet" href="../css/indexcss.css" />
    <link rel="stylesheet" href="../css/footer.css" />
    <link rel="stylesheet" href="../css/PossibleFlights.css" />
    <link rel="stylesheet" href="../css/title.css" />
  </head>
  <body>
    <header>
      <div id="login" onclick="location.href='../index.php'">
      <?php
        session_start();
        echo '<h3>Welcome '. $_SESSION["username"] . '</h3>';
      ?>
      </div>
        <?php
        echo '<div id="viewSaved" onclick=document.location.href="../index.php">';
        echo '<h3>Return Home</h3>';
        echo '</div>';
        echo '<div id="logout">';
        echo '<h3 onclick=document.location.href="logout.php">Logout<h3>';
        echo '</div>';
        ?>
    </header>
     <hr id="resultsDivider">
     <h1 id="savedFlightsHeader">Your Saved flights</h1>
    <?php 
    $db = "customers_and_bookings";
    $conn = mysqli_connect("localhost", "root", "", $db);
     
    if(!$conn) {
       echo "Connection error" . mysqli_connect_error();
    }

    $username = mysqli_real_escape_string($conn, $_SESSION["username"]);
     
    $sql = "SELECT * FROM customers_and_bookings.bookings WHERE username='$username';";

    $flightData = $conn->query($sql);
    //$tempArray = implode(",", $flightData);
    
    if($flightData->num_rows > 0)
    {
            while($singleBooking = $flightData->fetch_assoc())
            {
              echo '<div class="startOfGrid">';
                  echo '<h2>Carrier: '.$singleBooking['name'].'</h2>';
                  echo '<h2>Price: $'.$singleBooking['price'].'</h2>';
                    echo '<div class="travelInfo">';
                      echo '<h3>Leave On: '.$singleBooking['departureDate'].'</h3>';
                      echo '<h3>Travel Time: '.$singleBooking['flightTimeDeparting'].'</h3>';
                        echo '<div class="subgrid">';
                          echo '<div>';
                            echo '<h3>'.$singleBooking['departingAirport'].'</h3>';
                            echo '<h3>'.$singleBooking['departureTime'].'</h3>';
                              echo '</div>';
                                echo '<img src="../images/rightArrow.png">';
                                  echo '<div>';
                                    echo '<h3>'.$singleBooking['arrivingAirport'].'</h3>';
                                    echo '<h3>'.$singleBooking['arrivalTime'].'</h3>';
                          echo '</div>';
                        echo '</div>';
                    echo '</div>';
                        echo '<div class="travelInfo">';
                                    echo '<h3>Return On: '.$singleBooking['returnDate'].'</h3>';
                                    echo '<h3>Travel Time: '.$singleBooking['flightTimeReturning'].'</h3>';
                                    echo '<div class="subgrid">';
                                      echo '<div>';
                                        echo '<h3>'.$singleBooking['arrivingAirport'].'</h3>';
                                          echo '<h3>'.$singleBooking['returnDepartureTime'].'</h3>';
                                      echo '</div>';
                                    echo '<img src="../images/rightArrow.png">';
                                      echo '<div>';
                                          echo '<h3>'.$singleBooking['departingAirport'].'</h3>';
                                          echo '<h3>'.$singleBooking['returnArrivalTime'].'</h3>';
                                      echo '</div>';
                                    echo '</div>';
                                  echo '</div>';
                echo '</div>';
            }
    }
    else{
      echo '<h1 id="emptySearchResultsMessage">Wow! Such empty</h1>';
    }
     
      ?>
  </body>
  <footer>
    <hr id="footerLabel" data-content="Jet...Set...Go">
    <div id="weblinks">
      <img src="../images/footerimages/whiteinstagram.png" alt="instagram link">
      <img src="../images/footerimages/whiteyoutube.png" alt="youtube link">
      <img src="../images/footerimages/whitelinkedin.png" alt="linked in link">
      <img src="../images/footerimages/whitegithub.png" alt="github link">
    </div>
    <p>A website by <a href="https://www.instagram.com/tristandelgado04/" target="_blank">Tristan Delgado</a></p>
    <div id="businesslinks">
      <a href="https://youtu.be/dQw4w9WgXcQ" target="_blank">Privacy</a>
      <a href="https://youtu.be/dQw4w9WgXcQ" target="_blank">Terms and Conditions</a>
      <a href="https://youtu.be/dQw4w9WgXcQ" target="_blank">Ad Choices</a>
      <a href="https://youtu.be/dQw4w9WgXcQ" target="_blank">Help/FAQ</a>
    </div>
  </footer>
</html>

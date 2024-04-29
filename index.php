<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JetSetGo!</title>
    <link rel="icon" type="image/x-icon" href="images/faviconPlane.svg">
    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzMjhFzxSPek63pRk6BA5mqSEtI4V4EGw&loading=async&libraries=places&callback=activatePlacesAutoComplete"></script>
    <script type="text/javascript" src="javascript/indexjs.js"></script>
    <script>
      function changePage(URL)
      {
        window.location.href = URL;
      }
    </script>
    <link rel="stylesheet" href="css/indexcss.css" />
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" href="css/PossibleFlights.css" />
  </head>
  <body>
    <header>
      <div id="login" onclick="location.href='php/login.php'">
        <?php
        session_start();
        if(!isset($_SESSION['username']))
        {
        echo '<h3>Log In<img src="images/loginicon.png" alt="A login icon"></h3>';
           //echo "<script>console.log('SessionUsername:'," . $_SESSION['username'] . ");</script>'";
        }
        else{
          echo '<h3>Welcome '. $_SESSION["username"] . '</h3>';
        }
        ?>
      </div>
      <?php
        if(isset($_SESSION['username']))
        {
          echo '<div id="viewSaved">';
          echo '<h3>View Saved<img src="images/saveicon.png" alt="A saved icon"></h3>';
          echo '</div>';
          echo '<div id="logout">';
          echo '<h3 onclick=document.location.href="php/logout.php">Logout<h3>';
          echo '</div>';
        }
      ?>
    </header>
    <div class="hero">
        <h4 class="title" id="mottoBeg">Fly further. Fly faster.</h4>
        <h1 class="title" id="mainMotto">Jet...Set...Go!</h1>
    </div>
    <div>
        <form id="searchform" method="post" action="index.php">
            <input class="inputclass" type="text" id="from" name="from" placeholder="From?">
            <input class="inputclass" type="text" id="to" name="to" placeholder="To?">
            <input class="inputclass" type="date" id="departDate" name="departDate" placeholder="Departure Date?">
            <input class="inputclass" type="date" id="returnDate" name="returnDate" placeholder="Return Date?"><br>
            <select class="inputclass" name="class">
                <option value="Economy">Economy</option>
                <option value="PremiumEconomy">Premium Economy</option>
                <option value="Business">Business</option>
                <option value="First">First</option>
            </select>
            <div id="passengersdiv">
              <img id="minus" class="addminus" src="images/minusSign.png" alt="minus Sign" onclick="minusPassenger()">
              <input class="inputclass" id="numPassengers" type="number" id="numPassengers" name="numPassengers" value="1" readonly>
              <img id="add" class="addminus" src="images/plusSign.png" alt="Plus Sign" onclick="plusPassenger()">
            </div>
            <input class="inputclass" type="button" id="triptype" value="Round Trip" onclick="changeTripType()">
            <input type="hidden" name="tripWayValue" value="Round Trip">
            <input class="inputclass" id="submit" type="submit" name="submit" value="Search">
        </form>
    </div>
      <hr id="resultsDivider">
      
      <?php 
      if(!isset($_SESSION['flightData']))
      {
      $_SESSION['flightData'] = null;
      echo '<h1 id="emptySearchResultsMessage">Wow! Such empty</h1>';
      }
      $numberOfFlightsToGet = 8;
        if(isset($_POST["submit"]))
        {
            echo '<script type="text/javascript">removeWow();</script>';

            $from = $_POST["from"];
            $to = $_POST["to"];
            $departDate = $_POST["departDate"];
            $returnDate = $_POST["returnDate"];
            $class = strtoUpper($_POST["class"]);
            $passengerAmt = $_POST["numPassengers"];
            $tripType = $_POST["tripWayValue"];

            $matches = array();
            $matches2 = array();

            preg_match("/(?!\()[A-Z]{3}(?=\))/", $from, $matches);
            $from = $matches[0];

            preg_match("/(?!\()[A-Z]{3}(?=\))/", $to, $matches2);
            $to = $matches2[0];

            $data = array(
            'grant_type' => "client_credentials",
            'client_id' => "afNMRc6cemzwHmVCseP8cC1vgGIc2wxF",
            'client_secret' => "6EeAX2WPqfHoT2IZ"
            );

            $ch = curl_init(); //This request is for getting the access token

            // Set the URL of the API endpoint
            curl_setopt($ch, CURLOPT_URL, 'https://test.api.amadeus.com/v1/security/oauth2/token');

            // Set the request method to POST
            curl_setopt($ch, CURLOPT_POST, 1);

            // Set the POST data
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

            // Set the content type
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

            // Return the response as a string instead of outputting it
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Execute the request
            $response = curl_exec($ch);

            // Check for errors
            if($response === false) {
                echo 'Error: ' . curl_error($ch);
            } else {
                // Decode the JSON response
                $response_data = json_decode($response, true);
    
                // Check if the access token exists in the response
                if(isset($response_data['access_token'])) {
                    $accessToken = $response_data['access_token'];
                } else {
                    echo 'Error: Unable to fetch access token'; } } 
            
            // Close the cURL session curl_close($ch);
            curl_close($ch);

            $curl_flightOffers = curl_init();


            $builtURL = 'https://test.api.amadeus.com/v2/shopping/flight-offers';
            $travel_data = array(
              'originLocationCode' => $from,
              'destinationLocationCode' => $to,
              'departureDate' => $departDate,
              'returnDate' => $returnDate,
              'adults' => $passengerAmt,
              'travelClass' => $class,
              'max' => $numberOfFlightsToGet,
              'currencyCode' => 'USD'
            );
            $params = http_build_query($travel_data);
            $builtURL = $builtURL.'?'.$params;

            curl_setopt_array($curl_flightOffers, [
              CURLOPT_URL => $builtURL,
              CURLOPT_POST => false,
              CURLOPT_HTTPHEADER => array(
              "Authorization: Bearer " . $accessToken,
              ),
              CURLOPT_RETURNTRANSFER => true,
            ]);

              $result = curl_exec($curl_flightOffers);
              if (curl_errno($curl_flightOffers)) {
               echo 'Error:' . curl_error($curl_flightOffers);
                }
              //print_r ($result);
              curl_close ($curl_flightOffers);
            
              //"Content-Type: application/json"

              //$curls = curl_init();

              //curl_setopt($curls, CURLOPT_URL, 'https://test.api.amadeus.com/v2/shopping/flight-offers?originLocationCode=EWR&destinationLocationCode=MIA&departureDate=2024-04-26&returnDate=2024-04-28&adults=1&max=1');
              //curl_setopt($curls, CURLOPT_POST, false);

              //curl_setopt($curls, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' .$accessToken));
              //$result = curl_exec($curls);
              //if (curl_errno($curls)) {
               //echo 'Error:' . curl_error($curls);
                //}
              //print_r ($result);
              //curl_close ($curls);

              //Storing all the flight data in an array which then is stored in another array
              //Data needed: 
              //Airline Name
              //Ticket Price
              //Departing Airport code
              //Arrival airport code
              //Departure time
              //arrival time
              //return departure time
              //return arrival time
              //departure date
              //return date
              $result = json_decode($result, true);
              $result_data = $result["data"];
              $count = 0;
              $flightData = array();
              $individualFlightData;
              while($count < $numberOfFlightsToGet)
              {
                $individualFlightData = array(
                  'name' => $result['dictionaries']['carriers'][$result_data[$count]["itineraries"][0]["segments"][0]["carrierCode"]],
                  'price' => $result_data[$count]['price']['base'],
                  'departingAirport' => $from,
                  'arrivingAirport' => $to,
                  'departureTime' => subStr($result_data[$count]["itineraries"][0]["segments"][0]["departure"]["at"], 11, 5),
                  'arrivalTime' => subStr($result_data[$count]["itineraries"][0]["segments"][0]["arrival"]["at"], 11, 5),
                  'returnDepartureTime' => subStr($result_data[$count]["itineraries"][1]["segments"][0]["departure"]["at"], 11, 5),
                  'returnArrivalTime' => subStr($result_data[$count]["itineraries"][1]["segments"][0]["arrival"]["at"], 11, 5),
                  'departureDate' => $departDate,
                  'returnDate' => $returnDate,
                  'flightTimeDeparting' => subStr($result_data[0]['itineraries'][0]['segments'][0]['duration'], 2, 5),
                  'flightTimeReturning' => subStr($result_data[0]['itineraries'][1]['segments'][0]['duration'], 2, 5),
                  'idNum' => $count,
                  'beenSelected' => false
                );
                $flightData[$count] = $individualFlightData;
                $count = $count + 1;
              }
              $_SESSION['flightData'] = $flightData;
              //echo json_encode($flightData); //Used to check contents of returned flight data for debugging
            $currentlyDisplayed = 0;
            while($currentlyDisplayed < $numberOfFlightsToGet)
            {
              echo '<div class="startOfGrid">';
                  echo '<h2>Carrier: '.$flightData[$currentlyDisplayed]['name'].'</h2>';
                  echo '<h2>Price: $'.$flightData[$currentlyDisplayed]['price'].'</h2>';
                  if($flightData[$currentlyDisplayed]['beenSelected'] == true)
                  {
                    echo '<h2 class="selected">Selected</h2>';
                  }
                    echo '<div class="travelInfo">';
                      echo '<h3>Leave On: '.$flightData[$currentlyDisplayed]['departureDate'].'</h3>';
                      echo '<h3>Travel Time: '.$flightData[$currentlyDisplayed]['flightTimeDeparting'].'</h3>';
                        echo '<div class="subgrid">';
                          echo '<div>';
                            echo '<h3>'.$flightData[$currentlyDisplayed]['departingAirport'].'</h3>';
                            echo '<h3>'.$flightData[$currentlyDisplayed]['departureTime'].'</h3>';
                              echo '</div>';
                                echo '<img src="images/rightArrow.png">';
                                  echo '<div>';
                                    echo '<h3>'.$flightData[$currentlyDisplayed]['arrivingAirport'].'</h3>';
                                    echo '<h3>'.$flightData[$currentlyDisplayed]['arrivalTime'].'</h3>';
                          echo '</div>';
                        echo '</div>';
                    echo '</div>';
                        echo '<div class="travelInfo">';
                                    echo '<h3>Return On: '.$flightData[$currentlyDisplayed]['returnDate'].'</h3>';
                                    echo '<h3>Travel Time: '.$flightData[$currentlyDisplayed]['flightTimeReturning'].'</h3>';
                                    echo '<div class="subgrid">';
                                      echo '<div>';
                                        echo '<h3>'.$flightData[$currentlyDisplayed]['arrivingAirport'].'</h3>';
                                          echo '<h3>'.$flightData[$currentlyDisplayed]['returnDepartureTime'].'</h3>';
                                      echo '</div>';
                                    echo '<img src="images/rightArrow.png">';
                                      echo '<div>';
                                          echo '<h3>'.$flightData[$currentlyDisplayed]['departingAirport'].'</h3>';
                                          echo '<h3>'.$flightData[$currentlyDisplayed]['returnArrivalTime'].'</h3>';
                                      echo '</div>';
                                    echo '</div>';
                                  echo '</div>';
                                  echo '<button class="flightOptionsSaveButtons" onclick=changePage("php\/storeFlight.php?idNum='.$currentlyDisplayed.'")>Save</button>';
                echo '</div>';
                $currentlyDisplayed += 1;
            }
        }
        else{
          if(isset($_SESSION['flightData']))
          {
            $flightData = $_SESSION['flightData'];
                $currentlyDisplayed = 0;
                while($currentlyDisplayed < $numberOfFlightsToGet)
                {
              echo '<div class="startOfGrid">';
                  echo '<h2>Carrier: '.$flightData[$currentlyDisplayed]['name'].'</h2>';
                                echo '<h2>Price: $'.$flightData[$currentlyDisplayed]['price'].'</h2>';
                                if($flightData[$currentlyDisplayed]['beenSelected'] == true)
                                {
                                  echo '<h2 class="selected">Selected</h2>';
                                }
                                echo '<div class="travelInfo">';
                                      echo '<h3>Leave On: '.$flightData[$currentlyDisplayed]['departureDate'].'</h3>';
                                      echo '<h3>Travel Time: '.$flightData[$currentlyDisplayed]['flightTimeDeparting'].'</h3>';
                                    echo '<div class="subgrid">';
                                      echo '<div>';
                                        echo '<h3>'.$flightData[$currentlyDisplayed]['departingAirport'].'</h3>';
                                          echo '<h3>'.$flightData[$currentlyDisplayed]['departureTime'].'</h3>';
                                    echo '</div>';
                                    echo '<img src="images/rightArrow.png">';
                                    echo '<div>';
                                          echo '<h3>'.$flightData[$currentlyDisplayed]['arrivingAirport'].'</h3>';
                                          echo '<h3>'.$flightData[$currentlyDisplayed]['arrivalTime'].'</h3>';
                                      echo '</div>';
                                  echo '</div>';
                                  echo '</div>';
                                  echo '<div class="travelInfo">';
                                    echo '<h3>Return On: '.$flightData[$currentlyDisplayed]['returnDate'].'</h3>';
                                    echo '<h3>Travel Time: '.$flightData[$currentlyDisplayed]['flightTimeReturning'].'</h3>';
                                    echo '<div class="subgrid">';
                                      echo '<div>';
                                        echo '<h3>'.$flightData[$currentlyDisplayed]['arrivingAirport'].'</h3>';
                                          echo '<h3>'.$flightData[$currentlyDisplayed]['returnDepartureTime'].'</h3>';
                                      echo '</div>';
                                    echo '<img src="images/rightArrow.png">';
                                      echo '<div>';
                                          echo '<h3>'.$flightData[$currentlyDisplayed]['departingAirport'].'</h3>';
                                          echo '<h3>'.$flightData[$currentlyDisplayed]['returnArrivalTime'].'</h3>';
                                      echo '</div>';
                                    echo '</div>';
                                  echo '</div>';
                                  echo '<button class="flightOptionsSaveButtons" onclick=changePage("php\/storeFlight.php?idNum='.$currentlyDisplayed.'")>Save</button>';
                                echo '</div>';
                    $currentlyDisplayed += 1;
                }
          }
        }
      ?>
  </body>
  <footer>
    <hr id="footerLabel" data-content="Jet...Set...Go">
    <div id="weblinks">
      <img src="images/footerimages/whiteinstagram.png" alt="instagram link">
      <img src="images/footerimages/whiteyoutube.png" alt="youtube link">
      <img src="images/footerimages/whitelinkedin.png" alt="linked in link">
      <img src="images/footerimages/whitegithub.png" alt="github link">
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

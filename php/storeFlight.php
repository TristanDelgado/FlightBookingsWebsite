<?php
session_start();
if(isset($_SESSION['username']))
{
    echo "Made it to the site";
    $idNum = $_GET["idNum"];
    $_SESSION['flightData'][$idNum]['beenSelected'] = true;
    $db = "customers_and_bookings";

    $conn = mysqli_connect("localhost", "root", "", $db);

    if(!$conn) {
        echo "Connection error" . mysqli_connect_error();
    }
    $singleFlight = $_SESSION['flightData'][$idNum];

    $username = $_SESSION['username'];
    $name = mysqli_real_escape_string($conn, $singleFlight["name"]);
    $departingAirport = mysqli_real_escape_string($conn, $singleFlight["departingAirport"]);
    $arrivingAirport = mysqli_real_escape_string($conn, $singleFlight["arrivingAirport"]);
    $departureTime = mysqli_real_escape_string($conn, $singleFlight["departureTime"]);
    $arrivalTime = mysqli_real_escape_string($conn, $singleFlight["arrivalTime"]);
    $returnDepartureTime = mysqli_real_escape_string($conn, $singleFlight["returnDepartureTime"]);
    $returnArrivalTime = mysqli_real_escape_string($conn, $singleFlight["returnArrivalTime"]);
    $departureDate = mysqli_real_escape_string($conn, $singleFlight["departureDate"]);
    $returnDate = mysqli_real_escape_string($conn, $singleFlight["returnDate"]);
    $flightTimeDeparting = mysqli_real_escape_string($conn, $singleFlight["flightTimeDeparting"]);
    $flightTimeReturning = mysqli_real_escape_string($conn, $singleFlight["flightTimeReturning"]);
    $price = mysqli_real_escape_string($conn, $singleFlight["price"]);
    $idNum = mysqli_real_escape_string($conn, $singleFlight["idNum"]);

    $sql = "INSERT INTO bookings(username, name, departingAirport, arrivingAirport, departureTime, arrivalTime, returnDepartureTime, returnArrivalTime, departureDate, returnDate, flightTimeDeparting, flightTimeReturning,price, idNum) VALUES ('$username', '$name', '$departingAirport', '$arrivingAirport', '$departureTime', '$arrivalTime', '$returnDepartureTime', '$returnArrivalTime', '$departureDate', '$returnDate', '$flightTimeDeparting', '$flightTimeReturning', '$price', '$idNum')";

    if(mysqli_query($conn, $sql))
    {
        header("Location: ../index.php");
    }
    else{
        echo "query error: " . mysqli_error($conn);
    }
}
?>
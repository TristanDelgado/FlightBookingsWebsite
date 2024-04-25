<?php

    $db = "customers_and_bookings";
    $conn = mysqli_connect("localhost", "root", "", $db);

    if(!$conn) {
        echo "Connection error" . mysqli_connect_error();
    }

$firstName = mysqli_real_escape_string($conn, $_POST["firstname"]);
$lastName = mysqli_real_escape_string($conn, $_POST["lastname"]);
$userName = mysqli_real_escape_string($conn, $_POST["username"]);
$email = mysqli_real_escape_string($conn, $_POST["signupemail"]);
$password = mysqli_real_escape_string($conn, $_POST["signuppass"]);
$address = mysqli_real_escape_string($conn, $_POST["address"]);

echo "<script>console.log('firstName:', $firstName);</script>'";

$sql = "INSERT INTO users(username, email, password, first_name, last_name, address) VALUES ('$userName', '$email', '$password', '$firstName', '$lastName', '$address')";

echo "<script>console.log('SQL:', $sql);</script>'";

if(mysqli_query($conn, $sql))
{
    session_start();
    $_SESSION["username"] = $userName;
    header("Location: ../index.php");
}
else{
    echo "query error: " . mysqli_error($conn);
}




?>
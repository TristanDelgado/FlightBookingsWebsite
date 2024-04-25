<?php

    $db = "customers_and_bookings";

    $conn = mysqli_connect("localhost", "root", "", $db);

    if(!$conn) {
        echo "Connection error" . mysqli_connect_error();
    }
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $sql = 'SELECT count(*) FROM customers_and_bookings.users WHERE username="' . $username . '"' . 'AND password="' . $password .'"';
    if(mysqli_query($conn, $sql))
    {
        session_start();
        $_SESSION["username"] = $username;
        //echo $_SESSION["username"];
        header("Location: ../index.php");
    }
    else{
        echo "query error: " . mysqli_error($conn);
    }
    
?>
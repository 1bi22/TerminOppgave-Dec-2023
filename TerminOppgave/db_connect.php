<?php
    $server = "localhost";
    $user = "root";
    $pw = "Admin";
    $db = "terminoppgave";

    $conn = mysqli_connect($server, $user, $pw, $db);

    if(!$conn) {
        echo "Connection failed: " . mysqli_connect_error();
    }
?>

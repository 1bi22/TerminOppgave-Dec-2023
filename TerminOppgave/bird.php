<?php
include "db_connect.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $player = $_SESSION['id'];
    $Score = $_POST["flappyScore"];
    $Name = $_SESSION['username'];
    $sql = "INSERT INTO BirdScore (ScoreBird, idProfil, Brukernavn) VALUE ('$Score', '$player', '$Name');";
    $result = mysqli_query($conn, $sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body id="birdBody">
    <canvas id="birdBoard"></canvas>

    <form id="birdForm" method="POST">
        <input type="number" name="flappyScore" id="flappyScore"></input>
    </form>
    
<script src="script.js"></script>
</body>
</html>
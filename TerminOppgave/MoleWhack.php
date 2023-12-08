<?php

include "db_connect.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $player = $_SESSION["id"];
    $Score = $_POST["moleScore"];
    $Name = $_SESSION['username'];
    $sql = "INSERT INTO MoleScore (ScoreMole, idProfil, Brukernavn) VALUE ('$Score', '$player', '$Name')";
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
<body id="moleBody">
    <div id="moleHeader">
        <a href="Home.php"><button class="homeButton">Home</button></a>

        <form id="moleform" method="POST">
            <h3>SCORE:</h3><input type="number" name="moleScore" id="moleScore"></input>
        </form>
        <button id="moleStart" onclick="run(), counter()"><h1>START</h1></button>
        
    </div>
<div id="moleInnpakning">

    <div id="countdown" ></div>

    <div id="board"> 
    <div class="hole"></div>
    <div class="hole"></div>
    <div class="hole"></div>
    <div class="hole"></div>
    <div class="hole"></div>
    <div class="hole"></div>
    <div class="hole"></div>
    <div class="hole"></div>
    <div class="hole"></div>
    </div>

    <div class="filler"></div>
</div>
    <div class="cursor"></div>
    <script src="script.js"></script>
</body>
</html>
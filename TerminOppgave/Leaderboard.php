<?php
include "db_connect.php";
session_start();
$Player = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body id="leadboardBody">

    <a href="Home.php">
        <button class="homeButton">Home</button>
    </a>
    <?php
    //Her lager jeg 2 versjoner av tabellene, 2 tabeller som henter ut de 10 høyeste scorene fra databasen
    //og 2 tabbeller som henter ut dine top 5 scores
    $birdQuery = "SELECT * FROM BirdScore ORDER BY ScoreBird DESC LIMIT 10";
    $moleQuery = "SELECT * FROM MoleScore ORDER BY ScoreMole DESC LIMIT 10";
    $PBbirdQuery = "SELECT * FROM BirdScore WHERE idProfil = '$Player' ORDER BY ScoreBird DESC LIMIT 5";
    $PBmoleQuery = "SELECT * FROM MoleScore WHERE idProfil = '$Player' ORDER BY ScoreMole DESC LIMIT 5";

    $birdResult = mysqli_query($conn, $birdQuery);
    $moleResult = mysqli_query($conn, $moleQuery);
    $PBbirdResult = mysqli_query($conn, $PBbirdQuery);
    $PBmoleResult = mysqli_query($conn, $PBmoleQuery);

    
    echo "<div class='leaderboards'>";
    echo "<table class='leaderboardTable'>";
    echo "<tr> <th>FlappyBird Top 10</th></tr>";
    echo "<tr> <th>Score:</th> <th>Name:</th></tr>";

    while ($birdRow = mysqli_fetch_assoc($birdResult)) {
        echo "<tr><td>".$birdRow["ScoreBird"]."</td><td>".$birdRow["Brukernavn"]."</td></tr>";
};
    echo "</table>";
    
    echo "<table class='leaderboardTable'>";
    echo "<tr> <th>Whack a Mole Top 10</th></tr>";
    echo "<tr> <th>Score:</th> <th>Name:</th></tr>";
    
    while ($moleRow = mysqli_fetch_assoc($moleResult)) {
        echo "<tr><td>".$moleRow["ScoreMole"]."</td><td>".$moleRow["Brukernavn"]."</td></tr>";

     };
     echo "</table>";
     echo "</div>";

     //
     echo "<div class='leaderboards'>";
     echo "<table class='leaderboardTable'>";
     echo "<tr> <th>FlappyBird</th> <th>Personal Best</th></tr>";
     echo "<tr> <th>Score:</th> <th>Name:</th></tr>";
 
     while ($PBbirdRow = mysqli_fetch_assoc($PBbirdResult)) {
         echo "<tr><td>".$PBbirdRow["ScoreBird"]."</td><td>".$PBbirdRow["Brukernavn"]."</td></tr>";
     };
     echo "</table>";
     
     echo "<table class='leaderboardTable'>";
     echo "<tr> <th>Whack a Mole</th> <th>Personal Best</th></tr>";
     echo "<tr> <th>Score:</th> <th>Name:</th></tr>";
     
     while ($PBmoleRow = mysqli_fetch_assoc($PBmoleResult)) {
         echo "<tr><td>".$PBmoleRow["ScoreMole"]."</td><td>".$PBmoleRow["Brukernavn"]."</td></tr>";
         };
      echo "</table>";
      echo "</div>";
    ?>
</body>
</html>
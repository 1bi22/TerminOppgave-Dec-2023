<?php
include "db_connect.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body >
    
<a href="logout.php">
    <button class=homeButton>Logg ut</button>
</a>
<div id=homepage>
    
    <a href="MoleWhack.php">
        <img src=Images/mole.png height="250px">
        <h2>Whack a Mole</h2>
    </a>

    <a href="bird.php">
        <img src=Images/flappybird.png height="250px">
        <h2>FlappyBird</h2>
    </a>

    <a href="Leaderboard.php">
        <img src=Images/Leaderboard.png height="250px">
        <h2>Leaderboard</h2>
    </a>

</div>
</body>
</html>
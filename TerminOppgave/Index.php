<?php
include "db_connect.php"
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styling.css">
</head>
<body>

<form action="login.php" method="post">
    <h2>Login:</h2>
    <label>Bruker: </label>
    <input type="text" name="Brukernavn" placeholder="Brukernavn"><br/>
    <label>Passord: </label>
    <input type="password" name="Passord" placeholder="Passord"><br/>
    <button type="submit">Login</button><br/>
</form>
<a href="createUser.php"> <button>Lag bruker</button></a><br/>










</body>
</html>

<?php

?>
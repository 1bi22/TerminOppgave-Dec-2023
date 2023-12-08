<?php
session_start();
include "db_connect.php";



if(isset($_POST['Brukernavn']) && isset($_POST['Passord'])) {
function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

//her definer jeg variablene//

$brukernavn = validate($_POST['Brukernavn']);
$passord = validate($_POST['Passord']);

//Hvis brukernavn eller passord mangler sender dette en feilmelding til url
if(empty($brukernavn)) {
    header ("Location: createUser.php?error=Username is required!");
    exit();
}
else if(empty($passord)) {
    header ("Location: createUser.php?error=Password is required!");
    exit();
}

echo $_POST['Brukernavn'];

//her legges brukeren inn i databasen
$sql = "INSERT INTO Profiler (Brukernavn, Passord) VALUES ('".$brukernavn."', '".$passord."')"; 

// if statement for å sende brukeren tilbake til startsiden
if ($result = mysqli_query($conn, $sql)){
    header("location: index.php");

                }       

            

        }
     
?>

<!DOCTYPE html>
<html>
<head>

</head>
<body>
    <form method="post">
        <h2>Opprett bruker:</h2>
        <label>Bruker: </label>
    <input type="text" name="Brukernavn" placeholder="Brukernavn"><br/>
        <label>Passord: </label>
    <input type="password" name="Passord" placeholder="Passord"><br/>
    <input type="submit">
    </form>
    
</body>
</html>



<?php

?>
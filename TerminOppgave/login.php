<?php
include "db_connect.php";
session_start();

if(isset($_POST['Brukernavn']) && isset($_POST['Passord'])) {
    echo "test";

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


$brukernavn = validate($_POST['Brukernavn']);
$passord = validate($_POST['Passord']);

if(empty($brukernavn)) {
    header ("Location: index.php?error=Username is required!");
    exit();
}
else if(empty($passord)) {
    header ("Location: index.php?error=Password is required!");
    exit();
}

$sql = "SELECT * FROM Profiler WHERE Brukernavn='$brukernavn' AND Passord='$passord'"; 

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if($row['Brukernavn'] == $brukernavn && $row['Passord'] == $passord) {
        echo "Innlogget";
        $_SESSION['username'] = $row['Brukernavn'];
        $_SESSION['id'] = $row['idProfil'];
        header("Location: home.php");
        exit();
    }
    else {
        header("Location: index.php?error=Ugyldig brukernavn eller passord!");
        echo "hei";
        exit();
    }
}
else {
    header("Location: index.php");
        echo "hallo";
    exit();
}
}

?>
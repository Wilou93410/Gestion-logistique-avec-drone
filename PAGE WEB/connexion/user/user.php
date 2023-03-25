<?php
session_start(); 
echo "Bonjour " . $_SESSION['pseudo'] . "!";
if ($_SESSION['permission'] !== "user") {
    header("Location: ../index.php"); 
}
?>

<!DOCTYPE html>
<html>
<LINK href="../../style/style.css" rel="stylesheet" type="text/css">

    <head>
        <title>user</title>
    </head>
    <body>
    <h1>drone</h1>

        <p>Bonjour</p>
      
        <br>

        <button type="button" onclick="window.location.href='drone/drone.php';">scanner un carton</button>

    <button type="button" onclick="logout()">déconnexion</button>
<script>
    function logout() {
        window.location.href = '/pageweb/config/logout.php';
    }
</script>

    </body>
</html>

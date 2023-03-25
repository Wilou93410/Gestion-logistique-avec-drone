<?php
session_start(); 
if ($_SESSION['permission'] !== "admin") {
    header("Location: ../index.php"); 
}
?>

<!DOCTYPE html>
<html>
<LINK href="../../style/style.css" rel="stylesheet" type="text/css">

    <head>
        <title>admin</title>
    </head>

    <body>

        <br>

        <div class = button>

            utilisateur

                <button type="button" onclick="window.location.href='cruduser/createuser.php';">créer un utilisateur</button>

                <button type="button" onclick="window.location.href='cruduser/readuser.php';">afficher un utilisateur</button>

                <button type="button" onclick="window.location.href='cruduser/updateuser.php';">modifier un utilisateur</button>
                    
                <button type="button" onclick="window.location.href='cruduser/deleteuser.php';">supprimer un utilisateur</button>
    
        </div>

        <br><br>

        <div class = button> 

                scan

                <button type="button" onclick="window.location.href='scan/deletescan.php';">supprimer un scan </button>

                <button type="button" onclick="window.location.href='scan/readscan.php';">afficher les scan </button>

                <button type="button" onclick="window.location.href='scan/updatescan.php';">modifier un scan</button>

        </div>

    <script>
        function logout() {
        window.location.href = '/pageweb/config/logout.php';
        }
    </script>

    </body>
        
    <div class = deco> 

        <button type="button" onclick="logout()">déconnexion</button>

    </div>

</html>

<?php
require 'connexion.php'
?>
<html>
<link rel="stylesheet" href="CSS/style.css">
<form method="post">
    <label>Nom d'utilisateur :</label>
    <input type="text" name="username" required><br>
    <label>Mot de passe :</label>
    <input type="password" name="password" required><br>
    <input type="submit" name="submit" value="Se connecter">
</form>
 
</html>
<!--cette page permet d'effectuer la connexion des utilisateurs et de vérifié leurs identifiants, en fonctions de leurs rôles ca les renvoies sur une page soit admin soit employés. -->

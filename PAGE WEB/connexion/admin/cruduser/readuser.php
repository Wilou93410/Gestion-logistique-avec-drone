<?php
// Connexion à la base de données
require 'conf.php';

// Récupération des données de la table "utilisateur"
$sql = "SELECT * FROM user";
$result = mysqli_query($dbh, $sql);
$utilisateurs = mysqli_fetch_all($result, MYSQLI_ASSOC);


?>
<!doctype html>
<link rel="stylesheet" href="style.css">
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>affichage utilisateur</title>
  </head>
  <body>
<h1>Utilisateur</h1>
  <table>
    <tr>
    </tr>
    <?php foreach ($utilisateurs as $utilisateur): ?>
      <tr>
        <td><?= $utilisateur['username'] ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
  <footer>
  </footer>
  <button onclick="window.location.href = '/pageconnexion/index.php';">Retour</button>
</html>
<?php
// Connexion à la base de données
require 'C:\xampp\htdocs\PAGE WEB\config\configadmin.php';

// Récupération des données de la table "user"
$sql = "SELECT * FROM users";
$result = $dbh->query($sql);
$users = $result->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <LINK href="../../../style/style.css" rel="stylesheet" type="text/css">
    <title>Affichage users</title>
  </head>
  <body>
  <style>
    
    </style>
    <h1>Utilisateurs</h1>
    
    <table>
      <tr>
        <th>Pseudo</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>mot de passe</th>
        <th>droit</th>
      </tr>
      <?php foreach ($users as $user): ?>
        <tr>
          <td><?= $user['pseudo'] ?></td>
          <td><?= $user['name'] ?></td>
          <td><?= $user['firstname'] ?></td>
          <td><?= $user['password'] ?></td>
          <td><?= $user['permission'] ?></td>
          
        </tr>
      <?php endforeach; ?>
    </table>
      
    <button onclick="window.location.href = '../admin.php';">Retour</button>
  </body>
</html>

<?php
session_start(); 
echo "Bonjour " . $_SESSION['pseudo'] . "!";
if ($_SESSION['permission'] !== "admin") {
    header("Location: ../../index.php"); 
}

// Connexion à la base de données
require "../../../config/configadmin.php";

// Recherche d'utilisateur si une recherche a été soumise
if (isset($_GET['search'])) {
  $search = $_GET['search'];
  $sql = "SELECT * FROM users WHERE pseudo LIKE '%$search%' OR name LIKE '%$search%' OR firstname LIKE '%$search%' OR permission LIKE '%$search%'";
} else {
  // Récupération de tous les utilisateurs
  $sql = "SELECT * FROM users";
}

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

    <h1>Utilisateurs</h1>

    <form method="get" class=recherche>

      <label for="search">Recherche :</label>
      <input type="text" id="search" name="search" placeholder="rechercher un utilisateur">
      <button type="submit">Rechercher</button>

    </form>
    
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

    <div class="deco">
      <button onclick="window.location.href = '../admin.php';">retour</button>
    </div>

  </body>
</html>

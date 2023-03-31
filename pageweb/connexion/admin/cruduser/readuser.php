<?php
session_start(); 
if ($_SESSION['permission'] !== "admin") {
    header("Location: ../../index.php"); 
}

require "../../../config/configadmin.php";

if (isset($_GET['search'])) {
  $search = $_GET['search'];
  $sql = "SELECT * FROM users WHERE pseudo LIKE :search OR name LIKE :search OR firstname LIKE :search OR permission LIKE :search";
  $stmt = $dbh->prepare($sql);
  $stmt->execute(['search' => "%$search%"]);
} else {
  $sql = "SELECT * FROM users";
  $stmt = $dbh->query($sql);
}

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <br>
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

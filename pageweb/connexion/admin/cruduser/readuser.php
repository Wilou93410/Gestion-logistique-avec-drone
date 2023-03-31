<?php
session_start(); 
if ($_SESSION['permission'] !== "admin") {
    header("Location: ../../index.php"); 
}

require "../../../config/configadmin.php";

$search = "";
$sort_by = "";
$params = array();

// Requête de base sans recherche ni tri
$query = "SELECT * FROM users";

// Si une recherche est effectuée
if(isset($_POST['search'])) {
    $search = $_POST['search'];
    $query = "SELECT * FROM users WHERE pseudo LIKE :search OR name LIKE :search OR firstname LIKE :search OR permission LIKE :search";
    $params['search'] = '%' . $search . '%';
}

// Si un tri est demandé
if(isset($_GET['sort'])) {
    switch($_GET['sort']) {
        case 'pseudo':
            $sort_by = 'pseudo ASC';
            break;
        case 'name':
            $sort_by = 'name ASC';
            break;
        case 'firstname':
            $sort_by = 'firstname ASC';
            break;
        case 'permission':
            $sort_by = 'permission ASC';
            break;
        default:
            $sort_by = '';
    }
}

// Si un tri est défini, on l'ajoute à la requête
if(!empty($sort_by)) {
    $query .= " ORDER BY $sort_by";
}

// Exécution de la requête
$stmt = $dbh->prepare($query);
$stmt->execute($params);
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

    <form method="post" class=recherche>
      <input type="text" id="search" name="search" placeholder="rechercher un utilisateur" value="<?= $search ?>">
      <button type="submit">Rechercher</button>
    </form>
    <br>
    <table>
      <tr>
        <th><a href="?sort=pseudo">Pseudo</a></th>
        <th><a href="?sort=name">Nom</a></th>
        <th><a href="?sort=firstname">Prénom</a></th>
        <th>Mot de passe</th>
        <th><a href="?sort=permission">Droit</a></th>
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

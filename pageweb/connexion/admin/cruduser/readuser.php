<?php
session_start(); 
if ($_SESSION['permission'] !== "admin") {
    header("Location: ../../index.php"); 
}

require "../../../config/configadmin.php";

$search = "";
$order_by = "";

if (isset($_GET['search'])) {
  $search = $_GET['search'];
}

if (isset($_GET['order_by'])) {
  $order_by = $_GET['order_by'];
}

$order_by_options = array(
  "pseudo" => "Pseudo",
  "name" => "Nom",
  "firstname" => "Prénom",
  "permission" => "Rôle"
);

if ($order_by && !array_key_exists($order_by, $order_by_options)) {
  $order_by = "";
}

if ($search && $order_by) {
  $sql = "SELECT * FROM users WHERE pseudo LIKE :search OR name LIKE :search OR firstname LIKE :search OR permission LIKE :search ORDER BY $order_by";
  $stmt = $dbh->prepare($sql);
  $stmt->execute(['search' => "%$search%"]);
} elseif ($search) {
  $sql = "SELECT * FROM users WHERE pseudo LIKE :search OR name LIKE :search OR firstname LIKE :search OR permission LIKE :search";
  $stmt = $dbh->prepare($sql);
  $stmt->execute(['search' => "%$search%"]);
} elseif ($order_by) {
  $sql = "SELECT * FROM users ORDER BY $order_by";
  $stmt = $dbh->query($sql);
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

 
      <input type="text" id="search" name="search" placeholder="rechercher un utilisateur" value="<?= $search ?>">
      <button type="submit">Rechercher</button>

      </br>
      <div class ="box">

      <select id="order_by" name="order_by">
        <option value=""></option>
        <?php foreach ($order_by_options as $option_key => $option_label): ?>
          <option value="<?= $option_key ?>" <?= $option_key == $order_by ? "selected" : "" ?>><?= $option_label ?></option>
        <?php endforeach; ?>
      </select>

        </div>

      <button type="submit">Trier</button>

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

  </body

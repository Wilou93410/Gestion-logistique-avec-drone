<?php
session_start(); 
if ($_SESSION['permission'] !== "admin") {
    header("Location: ../../index.php"); 
}

require "../../../config/configadmin.php";

$sql = "SELECT * FROM scan INNER JOIN users on scan.id_user = users.id_user";
$search = '';
if(isset($_POST['search'])) {
    $search = $_POST['search'];
    $sql .= " WHERE name LIKE '%$search%' OR firstname LIKE '%$search%' OR pseudo LIKE '%$search%' OR dates LIKE '%$search%' OR id_carton LIKE '%$search%'";
}
$result = $dbh->query($sql);
$scans = $result->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <LINK href="../../../style/style.css" rel="stylesheet" type="text/css">
    <title>Affichage scans</title>
  </head>
  <body>
    <h1>Utilisateurs</h1>

    <form method="post" class=recherche>
        <label for="search">Rechercher :</label>
        <input type="text" name="search" value="<?= $search ?>">
        <button type="submit">Rechercher</button>
    </form>
<br>
    <table>

      <tr>
        <th>id_scan</th>
        <th>carton</th>
        <th>date</th>
        <th>pseudo</th>
        <th>nom</th>
        <th>prénom</th>
      </tr>

      <?php foreach ($scans as $scan): ?>
        
        <tr>
          <td><?= $scan['id_scan'] ?></td>
          <td><?= $scan['id_carton'] ?></td>
          <td><?= $scan['dates'] ?></td>
          <td><?= $scan['pseudo'] ?></td>
          <td><?= $scan['name'] ?></td>
          <td><?= $scan['firstname'] ?></td>
        </tr>

      <?php endforeach; ?>

    </table>
    <div class="deco">
    <button onclick="window.location.href = '../admin.php';">retour</button>

  </body>
</html>

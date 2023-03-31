<?php
session_start();
if ($_SESSION['permission'] !== "admin") {
    header("Location: ../../index.php");
    exit;
}

require_once "../../../config/configadmin.php";

$search = '';
$query = "SELECT * FROM scan INNER JOIN users ON scan.id_user = users.id_user";
$params = array();

if(isset($_POST['search'])) {
    $search = $_POST['search'];
    $query .= " WHERE name LIKE :search OR firstname LIKE :search OR pseudo LIKE :search OR dates LIKE :search OR id_carton LIKE :search";
    $params['search'] = '%' . $search . '%';
}

$stmt = $dbh->prepare($query);
$stmt->execute($params);
$scans = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../../style/style.css" rel="stylesheet" type="text/css">
    <title>Affichage scans</title>
</head>
<body>
    <h1>Utilisateurs</h1>

    <form method="post" class="recherche">
        <label for="search">Rechercher :</label>
        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>">
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
    </div>
</body>
</html>

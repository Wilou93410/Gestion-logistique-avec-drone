<?php
session_start();
if ($_SESSION['permission'] !== "admin") {
    header("Location: ../../index.php");
    exit;
}

require_once "../../../config/configadmin.php";

$search = '';
$sort_by = '';
$query = "SELECT * FROM scan INNER JOIN users ON scan.id_user = users.id_user";
$params = array();

if(isset($_POST['search'])) {
    $search = $_POST['search'];
    $query .= " WHERE name LIKE :search OR firstname LIKE :search OR pseudo LIKE :search OR dates LIKE :search OR id_carton LIKE :search";
    $params['search'] = '%' . $search . '%';
}

if(isset($_GET['sort'])) {
    switch($_GET['sort']) {
        case 'name':
            $sort_by = 'name ASC';
            break;
        case 'firstname':
            $sort_by = 'firstname ASC';
            break;
        case 'date':
            $sort_by = 'dates ASC';
            break;
        case 'carton':
            $sort_by = 'id_carton ASC';
            break;
        default:
            $sort_by = '';
    }
}

if(!empty($sort_by)) {
    $query .= " ORDER BY $sort_by";
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
    <h1>Scan</h1>

    <form method="post" class="recherche">
        <label for="search">Rechercher :</label>
        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Rechercher</button>
    </form>
    <br>
    <table>
        <tr>
            <th><a href="?sort=id_scan">id_scan</a></th>
            <th><a href="?sort=carton">carton</a></th>
            <th><a href="?sort=date">date</a></th>
            <th><a href="?sort=pseudo">pseudo</a></th>
            <th><a href="?sort=name">nom</a></th>
            <th><a href="?sort=firstname">prénom</a></th>
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

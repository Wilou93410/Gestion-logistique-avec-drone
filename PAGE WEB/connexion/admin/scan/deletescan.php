<?php

session_start(); 
if ($_SESSION['permission'] !== "admin") {
    header("Location: ../../index.php"); 
}

require "../../../config/configadmin.php";

$sql = "SELECT * FROM scan INNER JOIN users on scan.id_user = users.id_user";


$result = $dbh->query($sql);
$scans = $result->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['scan'])) {
    $id_scan = $_POST['scan'];

    $sql = "DELETE FROM scan WHERE id_scan = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id_scan]);

    if ($stmt->rowCount() > 0) {
        echo "Données utilisateur supprimées avec succès";
    } else {
        echo "Erreur";
    }
}
?>

<!doctype html>
<html lang="en">
<link rel="stylesheet" href="style.css">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <LINK href="../../../style/style.css" rel="stylesheet" type="text/css">
    <title>Suppression d'utilisateur</title>
</head>

<body>

<h1>Suppression de scan</h1>

    <body>
            
        <form method="post" class='scan'>
        <div class ="boxscan">
            <select class="form-select" aria-label="Default select example" name="scan" required>
                <?php foreach ($scans as $scan): ?>
                    <option value="<?= $scan['id_scan']?>"><?= $scan['id_scan']?>  <?= $scan['id_carton']?>  <?= $scan['dates']?>  <?= $scan['pseudo']?> <?= $scan['name']?> <?= $scan['firstname']?></option>
                <?php endforeach; ?>
            </select>
            </div>
            <button type="submit" value="supprimer">supprimer</button>

        </form>

    </body>
    <div class ="deco">
    <button onclick="window.location.href = '../admin.php';">retour</button>

</html>

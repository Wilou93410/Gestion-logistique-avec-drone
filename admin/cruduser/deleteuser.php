<?php
session_start(); 
if ($_SESSION['permission'] !== "admin") {
    header("Location: ../../index.php"); 
}

require "../../config/config.php";

$sql = "SELECT * FROM users";
$result = $dbh->query($sql);
$users = $result->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['user'])) {
    $pseudo = $_POST['user'];

    $sql = "DELETE FROM users WHERE pseudo = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$pseudo]);

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
    <LINK href="../../style.css" rel="stylesheet" type="text/css">
    <title>Suppression d'utilisateur</title>
</head>

<body>
<h1>Suppression d'utilisateurs</h1>

    <form method="post" class="form">

    <div class ="box">

        <select aria-label="Default select example" name="user" required>
            <?php foreach ($users as $user): ?>
                <option value="<?= $user['pseudo']?>"><?= $user['name']?>  <?= $user['firstname']?></option>
            <?php endforeach; ?>
        </select>

        </div>
        
        <button type="submit" value="supprimer">supprimer</button>       
        
    </form>

    <div class ="deco">
        <button onclick="window.location.href = '../admin.php';">retour</button>
    </div>

</html>

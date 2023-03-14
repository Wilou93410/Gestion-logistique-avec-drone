<?php
$dbh = new PDO('mysql:host=localhost;dbname=userscan', 'admin', 'admin');

// Récupération des données de la table "users"
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
    <LINK href="../../../style/style.css" rel="stylesheet" type="text/css">
    <title>Suppression d'utilisateur</title>
</head>

<body>
    <h1>Suppression d'utilisateur</h1>
    <form method="post">
        <select class="form-select" aria-label="Default select example" name="user" required>
            <?php foreach ($users as $user): ?>
                <option value="<?= $user['pseudo']?>"><?= $user['name']?>  <?= $user['firstname']?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="supprimer">
    </form>
    <footer>
    </footer>
    <button onclick="window.location.href = '../admin.php';">Retour</button>
</html>

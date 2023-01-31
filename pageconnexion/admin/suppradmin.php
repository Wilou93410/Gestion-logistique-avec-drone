<?php
// Connexion à la base de données
require 'conf.php';

// Récupération des données de la table "utilisateur"
$sql = "SELECT * FROM utilisateur";
$result = mysqli_query($dbh, $sql);
$utilisateurs = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Vérification de la soumission du formulaire
if (isset($_POST['utilisateur'])) {
    $username = $_POST['utilisateur'];
    // Prepare and execute the SQL statement to delete the user
    $sql = "DELETE FROM utilisateur WHERE username = '$username'";
    mysqli_query($dbh, $sql);

    if ($dbh->query($sql) === TRUE) {
       echo "Données utilisateur supprimé avec succès";
  } else {
      echo "Erreur";}}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Suppression d'utilisateur</title>
  </head>
  <body>
<h1>Suppression d'utilisateur</h1>
  <form method="post">
    <select class="form-select" aria-label="Default select example" name="utilisateur" required>
    <?php foreach ($utilisateurs as $utilisateur): ?>
        <option value="<?= $utilisateur['username']?>"><?= $utilisateur['username']?></option>
    <?php endforeach; ?>
    </select>
    <input type="submit" value="supprimer">
  </form>
  <footer>
  </footer>
  <button onclick="window.location.href = '/pageconnexion/1.php';">Retour</button>
</html>
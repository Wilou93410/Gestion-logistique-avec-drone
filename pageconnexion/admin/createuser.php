
<?php 
// Connexion à la base de données
require 'conf.php';

// Récupération des données de la table "fonction"
$fonctions = $dbh->query('SELECT * FROM fonction');

// Stockage des données du formulaire
if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['id_fonction'])) {
    $user = $_POST['username'];
    $password = $_POST['password'];
    $id_fonction = $_POST['id_fonction'];

    // Insertion des données dans la table "utilisateur"
    $sql = "INSERT INTO utilisateur (username, password, id_fonction) VALUES ('$user', '$password', '$id_fonction')";

    if ($dbh->query($sql) === TRUE) {
        echo "Données utilisateur insérées avec succès";
    } else {
        echo "Erreur";}}
?>
<!-- formulaire de création d'utilisateur -->
<!doctype html>
<html lang="en">
<link rel="stylesheet" href="style.css">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>création d'utilisateur</title>
  </head>
  <body>
<H1>création d'utilisateur</H1>
  <form method="post">
  <label for="user">Nom d'utilisateur :</label>
  <input type="text" id="username" name="username" required>
  <br><br>
  <label for="password">Mot de passe :</label>
  <input type="password" id="password" name="password" required>
  <br><br>

<select class="form-select" aria-label="Default select example" name="id_fonction" required>
<?php foreach ($fonctions as $fonction): ?>
    <option value="<?= $fonction['id_fonction']?>">fonction : <?= $fonction['fonction']?></option>
    <?php endforeach; ?>
    
</select>
<input type="submit" value="Envoyer">
</form>
   
  <footer>

    
</footer>
<button onclick="window.location.href = '/pageconnexion/1.php';">Retour</button>
</html>
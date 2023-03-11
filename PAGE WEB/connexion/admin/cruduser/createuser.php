
<?php 
// Connexion à la base de données

$dbh = new mysqli("localhost", "admin", "admin", "userscan");

// Récupération des données de la table "fonction"

$droits = $dbh->query('SELECT * FROM droit');

// Stockage des données du formulaire

if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['droit'])) {
    $name = $_POST['nom'];
    $surname = $_POST['prenom'];
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];
    $droit = $_POST['droit'];
    
    // Insertion des données dans la table "utilisateur"

    $sql = "INSERT INTO utilisateurs (nom, prenom, pseudo, password, droit) VALUES ( '$name', '$surname', '$pseudo', '$password', '$droit')";
    
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
  <label for="nom">nom :</label>
  <input type="text" id="nom" name="nom" required>
  <br><br>
  <label for="prenom">prenom :</label>
  <input type="text" id="prenom" name="prenom" required>
  <br><br>
  <label for="pseudo">pseudo :</label>
  <input type="text" id="pseudo" name="pseudo" required>
  <br><br>
  <label for="password">password :</label>
  <input type="password" id="password" name="password" required>
  <br><br>

<P> 1 = Administrateur; 2 = Droit employés </p>
<select class="form-select" aria-label="Default select example" name="droit" required>
<?php foreach ($droits as $droit): ?>
    <option value="<?= $droit['droit']?>">fonction : <?= $droit['droit']?></option>
    <?php endforeach; ?>  
</select>
<br><br>
<input type="submit" value="Envoyer">
</form>
   
  <footer>

    
</footer>
<br><br>
<button onclick="window.location.href = '/pageconnexion/1.php';">Retour</button>
</html>


<?php 
// Connexion à la base de données
require 'conf.php';

// Récupération des données de la table "fonction"
$fonctions = $dbh->query('SELECT * FROM fonction');
$sex = $dbh->query('SELECT * FROM identity');

// Stockage des données du formulaire
if (!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['idIdentity']) && !empty($_POST['idFonction'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $id_identity = $_POST['idIdentity'];
    $id_fonction = $_POST['idFonction'];

    // Insertion des données dans la table "utilisateur"

    $sql = "INSERT INTO user (name, surname, username, password, idIdentity, idFonction) VALUES ('$name', '$surname', '$username', '$password', '$id_identity', '$id_fonction')";
    
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
  <label for="name">name :</label>
  <input type="text" id="name" name="name" required>
  <br><br>
  <label for="surname">surname :</label>
  <input type="text" id="surname" name="surname" required>
  <br><br>
  <label for="user">username :</label>
  <input type="text" id="username" name="username" required>
  <br><br>
  <label for="password">password :</label>
  <input type="password" id="password" name="password" required>
  <br><br>

<select class="form-select" aria-label="Default select example" name="idIdentity" required>
<?php foreach ($sex as $identity): ?>
    <option value="<?= $identity['idIdentity']?>">sex : <?= $identity['sex']?></option>
    <?php endforeach; ?>  
</select>

<br><br>

<select class="form-select" aria-label="Default select example" name="idFonction" required>
<?php foreach ($fonctions as $fonction): ?>
    <option value="<?= $fonction['idFonction']?>">fonction : <?= $fonction['fonction']?></option>
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

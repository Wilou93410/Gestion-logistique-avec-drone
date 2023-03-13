<?php 
// Connexion à la base de données
$dbh = new PDO('mysql:host=localhost;dbname=userscan', 'admin', 'admin');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Récupération des données de la table "fonction"
$permissions = $dbh->query('SELECT * FROM permission');

// Stockage des données du formulaire
if (!empty($_POST['name']) && !empty($_POST['firstname']) && !empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['permission'])) {
    $name = $_POST['name'];
    $surname = $_POST['firstname'];
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];
    $permission = $_POST['permission'];
    
    // Insertion des données dans la table "utilisateur"
    $stmt = $dbh->prepare("INSERT INTO users (name, firstname, pseudo, password, permission) VALUES (:name, :firstname, :pseudo, :password, :permission)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':firstname', $surname);
    $stmt->bindParam(':pseudo', $pseudo);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':permission', $permission);
    
    if ($stmt->execute()) {
        echo "Données utilisateur insérées avec succès";
    } else {
        echo "Erreur";
    }
}
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
  <label for="firstname">firstname :</label>
  <input type="text" id="firstname" name="firstname" required>
  <br><br>
  <label for="pseudo">pseudo :</label>
  <input type="text" id="pseudo" name="pseudo" required>
  <br><br>
  <label for="password">password :</label>
  <input type="password" id="password" name="password" required>
  <br><br>

<select class="form-select" aria-label="Default select example" name="permission" required>
<?php foreach ($permissions as $permission): ?>
    <option value="<?= $permission['permission']?>">fonction : <?= $permission['permission']?></option>
    <?php endforeach; ?>  
</select>
<br><br>
<input type="submit" value="Envoyer">
</form>
   
  <footer>

    
</footer>
<br><br>
<button onclick="window.location.href = '/admin/admin.php';">Retour</button>
</html>

<?php 
session_start();

// Connexion à la base de données
$dbh = new PDO('mysql:host=localhost;dbname=userscan', 'admin', 'admin');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Récupération des permissions
$permissions = $dbh->query('SELECT * FROM permission');

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $surname = $_POST['firstname'];
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];
    $permission = $_POST['permission'];
    
    // Insertion de l'utilisateur dans la base de données
    $stmt = $dbh->prepare("INSERT INTO users (name, firstname, pseudo, password, permission) VALUES (:name, :firstname, :pseudo, :password, :permission)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':firstname', $surname);
    $stmt->bindParam(':pseudo', $pseudo);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':permission', $permission);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Données utilisateur insérées avec succès";
        header("Location: ../cruduser/createuser.php");
        exit();
    } else {
        $_SESSION['error'] = "Erreur";
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
    <title>création d'utilisateur</title>
  </head>
  <body>
    <h1>création d'utilisateur</h1>
    
    <?php if(isset($_SESSION['error'])): ?>
        <div class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>
   <div class='label'> 
    <form method="post">
       
        <input type="text" id="name" name="name" required placeholder='Nom'>
        <br><br>
       
        <input type="text" id="firstname" name="firstname" required placeholder="Prénom">
        <br><br>
     
        <input type="text" id="pseudo" name="pseudo" required placeholder="Pseudo">
        <br><br>
      
        <input type="password" id="password" name="password" required placeholder="Mot de passe"  minlength="8" maxlength="16">
        <br><br>
<select class="form-select" aria-label="Default select example" name="permission" required>
<?php foreach ($permissions as $permission): ?>
    <option value="<?= $permission['permission']?>">fonction : <?= $permission['permission']?></option>
    <?php endforeach; ?>  
</select>
<br><br>
<input type="submit" value="Envoyer">
</form>
</div>
  <footer>

    
</footer>
<br><br>
<button onclick="window.location.href = '../admin.php';">Retour</button>
</html>

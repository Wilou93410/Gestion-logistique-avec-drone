<?php

session_start();

// Connexion à la base de données
$dbh = new PDO('mysql:host=localhost;dbname=userscan', 'admin', 'admin');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Récupération des permissions
$permissions = $dbh->query('SELECT * FROM permission');

// Traitement du formulaire de sélection de l'utilisateur à modifier
if (isset($_POST['select_user'])) {
    $selected_user_id = $_POST['user_id'];
    $selected_user_stmt = $dbh->prepare("SELECT * FROM users WHERE id_user = :id_user");
    $selected_user_stmt->bindParam(':id_user', $selected_user_id);
    $selected_user_stmt->execute();
    $selected_user = $selected_user_stmt->fetch();
} else {
    $selected_user = null;
}

// Traitement du formulaire de modification de l'utilisateur
if (isset($_POST['update_user'])) {
    $id_user = $_POST['id_user'];
    $name = $_POST['name'];
    $firstname = $_POST['firstname'];
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];
    $permission = $_POST['permission'];

    $stmt = $dbh->prepare("UPDATE users SET name = :name, firstname = :firstname, pseudo = :pseudo, password = :password, permission = :permission WHERE id_user = :id_user");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':pseudo', $pseudo);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':permission', $permission);
    $stmt->bindParam(':id_user', $id_user);
    $stmt->execute();
}

?>
<!DOCTYPE html>
<html>
<LINK href="../../../style/style.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Raleway:200,100,400" rel="stylesheet" type="text/css" />
<head>
    <title>Modifier un utilisateur</title>
</head>
<body>
<h1>Modifier un utilisateurs
  <span
     class="txt-rotate"
     data-period="2000"
     data-rotate='[ "nerdy.", "simple.", "pure JS.", "pretty.", "fun!" ]'></span>
</h1>

    <!-- Formulaire de sélection de l'utilisateur à modifier -->
    <h2>Sélectionner un utilisateur à modifier</h2>
    <form method="post">
       
        <select name="user_id" id="user_id">
            <?php
            $users = $dbh->query('SELECT * FROM users');
            foreach ($users as $user) {
                echo '<option value="' . $user['id_user'] . '">' . $user['name'] . ' ' . $user['firstname'] . '</option>';
            }
            ?>
        </select>
        <button type="submit" name="select_user">Sélectionner</button>
    </form>

    <?php if ($selected_user): ?>

    <!-- Formulaire de modification de l'utilisateur sélectionné -->
    <h2>Modifier l'utilisateur sélectionné</h2>
<form method="post">
    <input type="hidden" name="id_user" value="<?php echo $selected_user['id_user']; ?>" >

    <input type="text" name="name" id="name" value="<?php echo $selected_user['name']; ?>" placeholder="nom"><br>
    
    <input type="text" name="firstname" id="firstname" value="<?php echo $selected_user['firstname']; ?>" placeholder="prénom"><br>
   
    <input type="text" name="pseudo" id="pseudo" value="<?php echo $selected_user['pseudo']; ?>" placeholder="pseudo"><br>
    
    <input type="password" name="password" id="password" placeholder="mot de passe" minlength=8 maxlength=16><br>
    
    <select name="permission" id="permission">
        <?php foreach ($permissions as $permission) {
            echo '<option value="' . $permission['permission'] . '"';
            if ($permission['permission'] == $selected_user['permission']) {
                echo ' selected';
            }
            echo '>' . $permission['permission'] . '</option>';
        } ?>
    </select><br>
    <button type="submit" name="update_user">Enregistrer les modifications</button>
</form>
</form>
<?php endif; ?>
<button onclick="window.location.href = '../admin.php';">Retour</button>
</body>
</html>
<?php

$dbh = null;
?>

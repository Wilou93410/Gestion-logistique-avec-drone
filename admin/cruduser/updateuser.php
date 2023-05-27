<?php

session_start(); 
if ($_SESSION['permission'] !== "admin") {
    header("Location: ../../index.php"); 
}

require "../../config/config.php";
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$permissions = $dbh->query('SELECT * FROM permission');

if (isset($_POST['select_user'])) {
    $selected_user_id = $_POST['user_id'];
    $selected_user_stmt = $dbh->prepare("SELECT * FROM users WHERE id_user = :id_user");
    $selected_user_stmt->bindParam(':id_user', $selected_user_id);
    $selected_user_stmt->execute();
    $selected_user = $selected_user_stmt->fetch();
} else {
    $selected_user = null;
}

if (isset($_POST['update_user'])) {
    $id_user = $_POST['id_user'];
    $name = $_POST['name'];
    $firstname = $_POST['firstname'];
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];
    $permission = $_POST['id_permission'];

    $stmt = $dbh->prepare("UPDATE users SET name = :name, firstname = :firstname, pseudo = :pseudo, password = :password, id_permission = :id_permission WHERE id_user = :id_user");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':pseudo', $pseudo);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':id_permission', $permission);
    $stmt->bindParam(':id_user', $id_user);
    $stmt->execute();
}

?>
<!DOCTYPE html>
<html>
<LINK href="../../style.css" rel="stylesheet" type="text/css">
<head>

    <title>Modifier un utilisateur</title>

</head>
<body>

<h1>Modifier un utilisateurs</h1>

    <form method="post" class=button>

    <div class ="box">

        <select name="user_id" id="user_id">
            <?php
            $users = $dbh->query('SELECT * FROM users');
            foreach ($users as $user) {
                echo '<option value="' . $user['id_user'] . '">' . $user['name'] . ' ' . $user['firstname'] . '</option>';
            } 
            ?>
        </select>

    </div>       

        <button type="submit" name="select_user">Sélectionner</button>

    </form>

    <?php if ($selected_user): ?>

    <form method="post" class="button">

        <input type="hidden" name="id_user" value="<?php echo $selected_user['id_user']; ?>" >

        <input type="text" name="name" id="name" value="<?php echo $selected_user['name']; ?>" placeholder="nom">
        
        <input type="text" name="firstname" id="firstname" value="<?php echo $selected_user['firstname']; ?>" placeholder="prénom">
    
        <input type="text" name="pseudo" id="pseudo" value="<?php echo $selected_user['pseudo']; ?>" placeholder="pseudo">
        
        <input type="password" name="password" id="password" placeholder="mot de passe" minlength=8 maxlength=16>
        
        <div class ="box">

        <select name="id_permission" id="id_permission">
            <?php foreach ($permissions as $permission) {
                echo '<option value="' . $permission['id_permission'] . '"';
                if ($permission['id_permission'] == $selected_user['id_permission']) {
                    echo ' selected';
                }
                echo '>' . $permission['permission'] . '</option>';
            } ?>
        </select>

        </div>

        <br>

        <button type="submit" name="update_user">Enregistrer les modifications</button>

    </form>

<?php endif; ?>

    <div class = deco>          

        <button onclick="window.location.href = '../admin.php';">retour</button>

    </div>

</html>

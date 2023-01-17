<?php

if(isset($_POST['submit'])) {
    // récupération des informations d'identification
    $username = $_POST['username'];
    $password = $_POST['password'];

    // connexion à la base de données
    $conn = new mysqli("localhost", "admin", "admin", "utilisateur");

    // vérification des informations d'identification
    $query = "SELECT * FROM utilisateur WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        
        // informations d'identification valides
        // récupération de la valeur de "userrole" dans la base de données
        $row = $result->fetch_assoc();
        $user_role = $row['userrole'];
        // démarrage de la session et stockage des informations d'utilisateur
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['userrole'] = $user_role;
        // redirection vers la page protégée
        header("Location: $user_role.php");
    } else {
        // informations d'identification incorrectes
        echo "Nom d'utilisateur ou mot de passe incorrect";
    }
}
?>
<html>
<form method="post">
    <label>Nom d'utilisateur :</label>
    <input type="text" name="username" required><br>
    <label>Mot de passe :</label>
    <input type="password" name="password" required><br>
    <input type="submit" name="submit" value="Se connecter">
</form>
 
</html>
<!--cette page permet d'effectuer la connexion des utilisateurs et de vérifié leurs identifiants, en fonctions de leurs rôles ca les renvoies sur une page soit admin soit employés. -->

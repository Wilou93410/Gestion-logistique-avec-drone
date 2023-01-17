

<?php
require "conf.php"
if(isset($_POST['submit'])) {
    // récupération des informations d'identification
    $username = $_POST['username'];
    $password = $_POST['password'];

    // connexion à la base de données
    $conn = new mysqli("host", "username", "password", "dbname");

    // vérification des informations d'identification
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // informations d'identification valides
        // démarrage de la session et stockage des informations d'utilisateur
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['user_role'] = $user_role;
        // redirection vers la page protégée
        header("Location: $_user_role.php");
    } else {
        // informations d'identification incorrectes
        echo "Nom d'utilisateur ou mot de passe incorrect";
    }
}
?>
<form method="post">
    <label>Nom d'utilisateur :</label>
    <input type="text" name="username" required><br>
    <label>Mot de passe :</label>
    <input type="password" name="password" required><br>
    <input type="submit" name="submit" value="Se connecter">
</form>



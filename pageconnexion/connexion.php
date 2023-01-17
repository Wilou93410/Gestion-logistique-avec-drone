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
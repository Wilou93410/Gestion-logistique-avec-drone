<?php

require "../config/configadmin.php";

if(isset($_POST['submit'])) {
    // récupération des informations d'identification
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];

    // vérification des informations d'identification
    $query = "SELECT * FROM users WHERE pseudo = ? AND password = ?";
    $stmt = $dbh->prepare($query);
    $stmt->execute([$pseudo, $password]);

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $user_role = $row['permission'];
        
        // démarrage de la session et stockage des informations d'utilisateur
        session_start();
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['permission'] = $user_role;
        $_SESSION['name'] = $name;
        $_SESSION['firstname'] = $firstname;

        if ($user_role == "admin") {
            header("Location: admin/admin.php");
            exit;
        } 
        
        else if ($user_role == "user"){
            header("Location: user/user.php");
            exit;
        }
        else {
            echo "Nom d'utilisateur ou mot de passe incorrect";
        }
    }
    else {
        echo "Nom d'utilisateur ou mot de passe incorrect";
    }
}
?>

<html>
<LINK href="../style/style.css" rel="stylesheet" type="text/css">

<body>

<form class = "form" method="post">

Connexion
    
    <input type="text" name="pseudo" placeholder="Nom d'utilisateur" required>
    
    <br><br>

    <input type="password" name="password" placeholder="Mot de passe" required>

    <br><br>

    <button type="submit" name="submit">se connecter</button>

</div>

</form>

</body>

</html>

<?php
$dbh = new PDO('mysql:host=localhost;dbname=userscan', 'admin', 'admin');
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
<link rel="stylesheet" href="CSS/index.scss">
<form method="post">
<LINK href="../style/style.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Raleway:200,100,400" rel="stylesheet" type="text/css" />
<h1>Page de connexion
  <span
     class="txt-rotate"
     data-period="2000"
     data-rotate='[ "nerdy.", "simple.", "pure JS.", "pretty.", "fun!" ]'></span>
</h1>



    <div class="textInputWrapper">
    <input type="text" name="pseudo" placeholder="Nom d'utilisateur" class="TextInput" required>
    </div>

    <div class="textInputWrapper">
    <input type="password" name="password" placeholder="Mot de passe" class="TextInput" required>
    </div>
    <br>

    <button type="submit" name="submit" class="btn">se connecter</button>

</form>
 
</html>
<!--cette page permet d'effectuer la connexion des utilisateurs et de vérifié leurs identifiants, en fonctions de leurs rôles ca les renvoies sur une page soit admin soit employés. -->

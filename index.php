<?php
require "config/config.php";

if (isset($_POST['submit'])) {
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];

    $query = "SELECT users.*, permission.permission FROM users
              JOIN permission ON users.id_permission = permission.id_permission
              WHERE pseudo = ? AND password = ?";
    $stmt = $dbh->prepare($query);
    $stmt->execute([$pseudo, $password]);

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $user_role = $row['permission'];
        $id_user = $row['id_user']; 

        session_start();
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['permission'] = $user_role;
        $_SESSION['name'] = $name;
        $_SESSION['firstname'] = $firstname;
        $_SESSION['id_user'] = $id_user;
        setcookie('permission', urlencode($user_role), time() + 3600, '/');
        setcookie('id_user', urlencode($id_user), time() + 3600, '/');

        if ($user_role == 'admin') { 
            header("Location: http://192.168.0.80:3003/user");
            exit;
        } else if ($user_role == 'user') {
            header("Location: http://192.168.0.80:3003/user");
            exit;
        } else {
            echo "nom d'utilisateur ou mot de passe incorrect";
        }
    } else {
        echo "nom d'utilisateur ou mot de passe incorrect";
    }
}
?>

<html>
<LINK href="style.css" rel="stylesheet" type="text/css">

<body>

<form class="form" method="post">

Connexion

    <input type="text" name="pseudo" placeholder="Nom d'utilisateur" required>

    <input type="password" name="password" placeholder="Mot de passe" required>

        <br>

    <button type="submit" name="submit">se connecter</button>

</div>

</form>

</body>

</html>

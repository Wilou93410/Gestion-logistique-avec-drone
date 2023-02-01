<!DOCTYPE html>
<html>
<link rel="stylesheet" href="CSS/style.css">
    <head>
        <title>admin</title>
    </head>
    <body>
        <h1>Page Admin</h1>
        <p>faite attention, sur cette page vous avez tout les droits, ne supprimez pas ou ne modifiez pas quelque choses sans avoir ce que vous faite au préalable,vous serez tenus pour responsable en cas de fausse manipulation, merci de votre compréhension</p>
        <button type="button" onclick="window.location.href='admin/modifadmin.php';">
        <span class ="transition"></span>
        <span class="gradient"></span>
        <span class="label">modifier</span>
        </button>
        <button type="button" onclick="window.location.href='admin/suppradmin.php';">
        <span class ="transition"></span>
        <span class="gradient"></span>
        <span class="label">supprimer</span>
        </button>
        <button type="button" onclick="window.location.href='admin/ajoutadmin.php';">ajouter</button>
        <button type="button" onclick="window.location.href='admin/createuser.php';">crée un utilisateur</button>
        <button type="button" onclick="window.location.href='utilisateur/afficherutilisateur.php';">Voir utilisateur</button>
    </body>
</html>

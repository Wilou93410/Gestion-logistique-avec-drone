<!DOCTYPE html>
<html>
<link rel="stylesheet" href="CSS/style.scss">
    <head>
        <title>admin</title>
    </head>
    <body>
    <h1>Admin
  <span
     class="txt-rotate"
     data-period="2000"
     data-rotate='[ "nerdy.", "simple.", "pure JS.", "pretty.", "fun!" ]'></span>
</h1>

        <p>faite attention, sur cette page vous avez tout les droits, ne supprimez pas ou ne modifiez pas quelque choses sans savoir ce que vous faite au préalable,vous serez tenus pour responsable en cas de fausse manipulation, merci de votre compréhension</p>
      
        <br>

        <div class ="btnn">  
        <button type="button" onclick="window.location.href='admin/modifadmin.php';">
        <span class="transition"></span>
        <span class="gradient"></span>
        <span class="label">modifier</span>
        </button>

        <button type="button" onclick="window.location.href='admin/suppradmin.php';">
        <span class="transition"></span>
  <span class="gradient"></span>
  <span class="label">supprimer</span>
    </button>

        <button type="button" onclick="window.location.href='admin/addbox/index.php';">
        <span class="transition"></span>
  <span class="gradient"></span>
  <span class="label">ajouter</span>
    </button>

        <button type="button" onclick="window.location.href='admin/user/index.php';">
        <span class="transition"></span>
  <span class="gradient"></span>
  <span class="label">Crée Utilisateur</span>
    </button>

        <button type="button" onclick="window.location.href='utilisateur/afficherutilisateur.php';">
        <span class="transition"></span>
  <span class="gradient"></span>
  <span class="label">Voir utilisateur</span>
    </button>
    </div> 
    </body>
</html>

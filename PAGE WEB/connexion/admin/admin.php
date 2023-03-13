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
        <button type="button" onclick="window.location.href='cruduser/createuser.php';">
        <span class="transition"></span>
        <span class="gradient"></span>
        <span class="label">crée un utilisateur</span>
        </button>

        <button type="button" onclick="window.location.href='cruduser/readuser.php';">
        <span class="transition"></span>
  <span class="gradient"></span>
  <span class="label">supprimer un utilisateur</span>
    </button>

        <button type="button" onclick="window.location.href='cruduser/updateuser.php';">
        <span class="transition"></span>
  <span class="gradient"></span>
  <span class="label">ajouter un utilisateur</span>

  <button type="button" onclick="window.location.href='cruduser/deleteuser.php';">
        <span class="transition"></span>
  <span class="gradient"></span>
  <span class="label">supprimer un utilisateur</span>
    </button>
    </button>
    </div> 
    </body>
</html>

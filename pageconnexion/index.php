<?php
require 'connexion.php'
?>
<html>
<link rel="stylesheet" href="CSS/index.scss">
<form method="post">

<link href="https://fonts.googleapis.com/css?family=Raleway:200,100,400" rel="stylesheet" type="text/css" />
<h1>Page de connexion
  <span
     class="txt-rotate"
     data-period="2000"
     data-rotate='[ "nerdy.", "simple.", "pure JS.", "pretty.", "fun!" ]'></span>
</h1>



    <div class="textInputWrapper">
    <input type="text" name="username" placeholder="Nom d'utilisateur" class="TextInput" required>
    </div>

    <div class="textInputWrapper">
    <input type="password" name="password" placeholder="Mot de passe" class="TextInput" required>
    </div>
    <br>

    <button type="submit" name="submit" class="btn">se connecter</button>

</form>
 
</html>
<!--cette page permet d'effectuer la connexion des utilisateurs et de vérifié leurs identifiants, en fonctions de leurs rôles ca les renvoies sur une page soit admin soit employés. -->
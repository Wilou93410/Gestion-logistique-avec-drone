<?php

//connexion sur la base de donnée

try {
    $pdo =new PDO('mysql:host=localhost;dbname=stock_carton',$_POST['nom'] , $_POST['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo $e->getMessage();}

?>
    <h1>Entrez les informations d'un fournisseur</h1>
        <form action='createfournisseur.php' method='post'>
            <label for="title">Désignation</label>
            <input type="text" id="designation" name="designation"> <br>
            <label for="adresse">adresse</label>
            <input type="text" id="adresse" name="adresse"> <br>
            <button type="submit">Valider</button>
        </form>

<?php 

?>
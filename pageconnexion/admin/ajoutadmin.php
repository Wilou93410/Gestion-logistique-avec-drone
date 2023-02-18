
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajout Carton</title>
    <link rel="stylesheet" href="style.css">
   <?php require 'connexion.php'; ?>
</head>
<body>
<h1>Ajouter un carton</h1><button onclick="history.go(-1);">retour</button>
    
        
    <form action="create.php" method="post">
    
        <label for="title">taille</label>
        <input type="text" id="taille" name="taille" oninput="change(this)">

        <label for='poids'>poids</label>
        <input type='float' id='poids' name='poids' oninput="change(this)">

        <label for='contenu'>contenu</label>
        <input type="text" id="taille" name="contenu" oninput="change(this)">

        <label for='quantite'>quantité</label>
        <input type="int" id="quantite" name="quantite" oninput="change(this)">
    
        <select name="destination" >
            <?php foreach ($dbh->query('SELECT * FROM destination ') as $destination): ?>
                <option value="<?= $destination['id_destination'] ?>" oninput="change(this)"><?= $destination['destination'] ?></option>
            <?php endforeach; ?>
        </select> </br>

        <select name="fournisseur" >
            <?php foreach ($dbh->query('SELECT * FROM fournisseur') as $fournisseur): ?>
                <option value="<?= $fournisseur['id_fournisseur'] ?>" oninput="change(this)"><?= $fournisseur['nom'] ?><?= $fournisseur['prenom'] ?><?= $fournisseur['adresse'] ?></option>
            <?php endforeach; ?>
        </select> </br>

        <select name="provenance" >
            <?php foreach ($dbh->query('SELECT * FROM provenance') as $provenance): ?>
                <option value="<?= $provenance['id_provenance'] ?>" oninput="change(this)"><?= $provenance['provenance'] ?></option>
            <?php endforeach; ?>
        </select> </br>

        <button type="submit">ajouter</button>
            
    </form>

    

<!-- le bouton download ne fonctionne pas :/ -->
<div class="code_qr">
    <img class="qrious">
    <div class="information">
        <p style="color:blue"> Valeur:</p>
        <p> Ici la valeur du code qr</p>
        <button id="download-btn">Télécharger</button>
    </div>
</div>
<script src="qrcode/download.js"></script> 
<script src="qrcode/qrious.js"></script>
<script src="qrcode/script.js"></script>
</body>
</html>
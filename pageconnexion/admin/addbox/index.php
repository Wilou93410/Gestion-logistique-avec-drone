
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
    
        <label for="serialNumber">numéro de série</label>
        <input type="text" id="serialNumber" name="serialNumber" oninput="change(this)">

        <label for='contents'>contenu</label>
        <input type='text' id='contents' name='contents' oninput="change(this)">

        <label for='quantity'>quantité</label>
        <input type="text" id="quantity" name="quantity" oninput="change(this)">

        <label for='arrivalDate'>date d'arrivé</label>
        <input type="datetime_local" id="arrivalDate" name="arrivalDate" oninput="change(this)">
    
        <select name="provider" >
            <?php foreach ($dbh->query('SELECT * FROM provider ') as $provider): ?>
                <option value="<?= $provider['idProvider'] ?>" oninput="change(this)"><?= $provider['company'] ?> <?= $provider['country'] ?> <?= $provider['city'] ?> <?= $provider['postCode'] ?><?= $provider['address'] ?></option>
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
<?php
try {
    $pdo =new PDO('mysql:host=localhost;dbname=stock_carton','root' , );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo $e->getMessage();};



$queryPrepare = $pdo->prepare("INSERT INTO fournisseur(designation, adresse) VALUES(?, ?)");
$queryPrepare->execute([$_POST['designation'], $_POST['adresse'], ]);


header('location: connexionadmin.php');
?>
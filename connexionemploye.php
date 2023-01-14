<?php
try {
    $pdo =new PDO('mysql:host=localhost;dbname=stock_carton',$_POST['nom'] , $_POST['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo $e->getMessage();}

?>
<?php 
try {
                $dbh =new PDO('mysql:host=localhost;dbname=cartons','admin' , 'admin');
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
                echo $e->getMessage();}

?>
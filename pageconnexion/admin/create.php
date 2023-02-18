<?php
require "connexion.php";



$queryPrepare = $dbh->prepare("INSERT INTO cartons(taille, poids, contenu, quantité, id_destination, id_provenance, id_fournisseur) VALUES(?, ?, ?, ? , ? , ?, ?)");
$queryPrepare->execute([$_POST['taille'], $_POST['poids'], $_POST['contenu'], $_POST['quantite'], $_POST['destination'], $_POST['provenance'], $_POST['fournisseur'] ]);


header('location: ajoutadmin.php');
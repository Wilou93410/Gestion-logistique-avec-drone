<?php
require "connexion.php";



$queryPrepare = $dbh->prepare("INSERT INTO box(serialNumber, contents, quantity, arrivalDate, idProvider,) VALUES(?, ?, ? , ? , ?)");
$queryPrepare->execute([$_POST['serialNumber'], $_POST['contents'], $_POST['quantity'], $_POST['arrivalDate'], $_POST['provider']]);


header('location: index.php');
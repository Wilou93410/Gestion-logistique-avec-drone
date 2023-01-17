<?php
// démarrage de la session
session_start();

// Stocker des variables de session
$_SESSION['username'] = $_POST['nom'];
$_SESSION['motdepasse'] = $_POST['mdp'];

?>
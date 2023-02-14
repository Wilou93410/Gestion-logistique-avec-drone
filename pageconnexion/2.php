<!DOCTYPE html>
<html>
<link rel="stylesheet" href="CSS/style.scss">
    <head>
        <title>Employe</title>
    </head>
    <body>
        <h1>Carton</h1>
        <p>Retrouve ici les informations des cartons</p>

               <div class ="btnn">  
        <button type="button" onclick="window.location.href='';">
        <span class="transition"></span>
        <span class="gradient"></span>
        <span class="label">ajouter cartons</span>
        </button>

         
        <button type="button" onclick="window.location.href='';">
        <span class="transition"></span>
        <span class="gradient"></span>
        <span class="label">informations cartons</span>
        </button>

</div>

     </body>
</html>
<?php
require 'carton.php';

if (isset($_POST['recherche'])) {
    $recherche = $_POST['recherche'];
    
    // Préparation de la requête SQL avec des jointures pour inclure les informations de la table de destination et de la table de provenance
    $sql = "SELECT cartons.*, destination.destination, fournisseur.nom, fournisseur.prenom, fournisseur.adresse, provenance.provenance FROM cartons
        JOIN destination ON cartons.id_destination = destination.id_destination
        JOIN fournisseur ON cartons.id_fournisseur = fournisseur.id_fournisseur
        JOIN provenance ON cartons.id_provenance = provenance.id_provenance
        WHERE cartons.contenu LIKE '%$recherche%' OR cartons.id_carton LIKE '%$recherche%' OR cartons.taille LIKE '%$recherche%' OR cartons.poids LIKE '%$recherche%' OR cartons.quantité LIKE '%$recherche%'";

    // Exécution de la requête et stockage des résultats
    $result = mysqli_query($dbh, $sql);
    
    // Vérifier si des résultats ont été trouvés
    if (mysqli_num_rows($result) > 0) {
    // Boucle à travers les enregistrements et affichage des informations du carton
    while($row = mysqli_fetch_assoc($result)) {
        echo "CARTONS : " . " Provenance : " . $row["provenance"]. " Destination : " . $row["destination"]. " Quantité : " . $row["quantité"]. " Poids : " . $row["poids"]. " Taille : " . $row["taille"]. " Contenu : " . $row["contenu"]. "<br>";
    }
} else {
    echo "Aucun résultat trouvé.";
}}

// Fermer la connexion à la base de données
mysqli_close($dbh);
?>

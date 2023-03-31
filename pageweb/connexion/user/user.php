<?php
session_start(); 
require "../../config/configcarton.php";
if ($_SESSION['permission'] !== "user") {
    header("Location: ../index.php"); 
}

$search = "";

if(isset($_GET['search'])) {
    $search = $_GET['search'];
}

$query = "SELECT carton.id_carton, carton.content, carton.delivery_date, carton.weight, supplier.id_supplier, supplier.address, supplier.postal_code, supplier.country, supplier.city, supplier.corporate_name 
          FROM carton 
          INNER JOIN supplier 
          ON carton.id_supplier = supplier.id_supplier 
          WHERE 
            carton.id_carton LIKE :search OR 
            carton.content LIKE :search OR 
            carton.delivery_date LIKE :search OR 
            carton.weight LIKE :search OR 
            supplier.id_supplier LIKE :search OR 
            supplier.address LIKE :search OR 
            supplier.postal_code LIKE :search OR 
            supplier.country LIKE :search OR 
            supplier.city LIKE :search OR 
            supplier.corporate_name LIKE :search";
$stmt = $dbh->prepare($query);
$stmt->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<LINK href="../../style/style.css" rel="stylesheet" type="text/css">

<head>
    <title>user</title>
</head>

<body>
    <h1>drone</h1>

    <p>Bonjour</p>

    <br>

    <form method="get" class=recherche>

        <label for="search">Recherche :</label>
        <input type="text" id="search" name="search" placeholder="rechercher un carton" value="<?php echo $search; ?>">
        <button type="submit">Rechercher</button>

    </form>

    <?php if (!empty($search)) { 
        if (!empty($result)) { ?>
            <table>
                <thead>
                    <tr>
                        <th>ID Carton</th>
                        <th>Contenu</th>
                        <th>Date de livraison</th>
                        <th>Poids</th>
                        <th>ID Fournisseur</th>
                        <th>Adresse</th>
                        <th>Code Postal</th>
                        <th>Pays</th>
                        <th>Ville</th>
                        <th>Nom de la société</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $row) { ?>
                        <tr>
                            <td><?php echo $row['id_carton']; ?></td>
                            <td><?php echo $row['content']; ?></td>
                            <td><?php echo $row['delivery_date']; ?></td>
                            <td><?php echo $row['weight']; ?></td>
                            <td><?php echo $row['id_supplier']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['postal_code']; ?></td>
                            <td><?php echo $row['country']; ?></td>
                            <td><?php echo $row['city']; ?></td>
                            <td><?php echo $row['corporate_name']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>Aucun résultat trouvé.</p>
        <?php }
    } else { ?>
        <p>Effectuez une recherche pour voir les résultats.</p>
    <?php } ?>


    <script>
        function logout() {
            window.location.href = '/pageweb/config/logout.php';
        }
    </script>

      <div class="deco">  
    <button type="button" onclick="window.location.href='drone/drone.php';">scanner un carton</button>
    </div>


    <div class="deco">
   
    <button type="button" onclick="logout()">déconnexion</button>

    </div>
</body>
</html>

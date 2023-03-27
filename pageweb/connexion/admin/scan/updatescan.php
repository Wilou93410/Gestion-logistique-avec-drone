<?php
require "../../../config/configadmin.php";

session_start();
if ($_SESSION['permission'] !== "admin") {
    header("Location: ../../index.php"); 
    exit;
}

try {
    $users_stmt = $dbh->query('SELECT * FROM users');
    $users = $users_stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des utilisateurs : " . $e->getMessage());
}


if (isset($_POST['select_scan'])) {
    $selected_scan_id = $_POST['scan_id'];
    try {
        $selected_scan_stmt = $dbh->prepare("SELECT id_scan, id_carton, id_user, dates FROM scan WHERE id_scan = :id_scan");
        $selected_scan_stmt->bindParam(':id_scan', $selected_scan_id);
        $selected_scan_stmt->execute();
        $selected_scan = $selected_scan_stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur lors de la récupération du scan : " . $e->getMessage());
    }
}
 else {
    $selected_scan = null;
}

if (isset($_POST['update_scan'])) {
    $id_scan = $_POST['id_scan'];
    $id_carton = $_POST['id_carton'];
    $id_user = $_POST['id_user'];

    try {
        $stmt = $dbh->prepare("UPDATE scan SET id_carton = :id_carton, id_user = :id_user WHERE id_scan = :id_scan");
        $stmt->bindParam(':id_carton', $id_carton);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':id_scan', $id_scan);
        $stmt->execute();
    } catch (PDOException $e) {
        die("Erreur lors de la mise à jour du scan : " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html>
<LINK href="../../../style/style.css" rel="stylesheet" type="text/css">
<head>
    <title>Modifier un scan</title>
</head>
<body>

<h1>Modifier un scan</h1>


<form method="post" class=button> 
  
<div class ="box">

    <select name="scan_id" id="scan_id">
        <?php
        $scans = $dbh->query('SELECT * FROM scan');
        foreach ($scans as $scan) {
            echo '<option value="' . $scan['id_scan'] . '">' . $scan['id_scan'] . ' ' .$scan['id_carton'] . '</option>';
        }
        ?>
    </select>

    </div>    
   
    <button type="submit" name="select_scan"> sélectionner</button>
    
</form>

<?php if ($selected_scan): ?>

<form method="post" class="button">

    <input type="hidden" name="id_scan"  value="<?php echo $selected_scan['id_scan']; ?>" >

    <input type="text" name="id_carton" id="id_carton" value="<?php echo $selected_scan['id_carton']; ?>" placeholder="id_carton">

    <div class ="box">

    <select name="id_user" id="id_user">

        <?php
        foreach ($users as $user) {
            echo '<option value="' . $user['id_user'] . '">' . $user['name'] . ' ' . $user['firstname'] . '</option>';
        }
        ?>
    </select>

    </div>

    <br>
    <button type="submit" name="update_scan">envoyer</button>

</form>
<?php endif; ?>
</body>

<div class = deco>   

    <button onclick="window.location.href = '../admin.php';" class="btn">retour</button>

</html>

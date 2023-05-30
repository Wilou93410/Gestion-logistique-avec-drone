<?php
session_start(); 
if ($_SESSION['permission'] !== "admin") {
    header("Location: ../../index.php"); 
}

require "../../config/config.php";

$search = "";
$sort_by = "";
$params = array();

$query = "SELECT u.*, p.permission FROM users u LEFT JOIN permission p ON u.id_permission = p.id_permission";

if(isset($_POST['search'])) {
    $search = $_POST['search'];
    $query .= " WHERE u.pseudo LIKE :search OR u.name LIKE :search OR u.firstname LIKE :search OR p.permission LIKE :search";
    $params['search'] = '%' . $search . '%';
}

if(isset($_GET['sort'])) {
    switch($_GET['sort']) {
        case 'pseudo':
            $sort_by = 'u.pseudo ASC';
            break;
        case 'name':
            $sort_by = 'u.name ASC';
            break;
        case 'firstname':
            $sort_by = 'u.firstname ASC';
            break;
        case 'permission':
            $sort_by = 'p.permission ASC';
            break;
        default:
            $sort_by = '';
    }
}

if(!empty($sort_by)) {
    $query .= " ORDER BY $sort_by";
}

$stmt = $dbh->prepare($query);
$stmt->execute($params);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <LINK href="../../style.css" rel="stylesheet" type="text/css">
    <title>Affichage users</title>
  </head>

  <body>

    <h1>Utilisateurs</h1>

    <form method="post" class=recherche>
      <input type="text" id="search" name="search" placeholder="rechercher un utilisateur" value="<?= $search ?>">
      <button type="submit">Rechercher</button>
    </form>
    <br>
    <table>
      <tr>
        <th><a href="?sort=pseudo">Pseudo</a></th>
        <th><a href="?sort=name">Nom</a></th>
        <th><a href="?sort=firstname">Prénom</a></th>
        <th>Mot de passe</th>
        <th><a href="?sort=permission">Droit</a></th>
      </tr>

      <?php foreach ($users as $user): ?>
  <tr>
    <td><?= $user['pseudo'] ?></td>
    <td><?= $user['name'] ?></td>
    <td><?= $user['firstname'] ?></td>
    <td class="password copyable"><?= $user['password'] ?></td>
    <td><?= $user['permission'] ?></td>
  </tr>
<?php endforeach; ?>
    </table>

    <div class="deco">
      <button onclick="window.location.href = '../admin.php';">retour</button>
    </div>
    
    <script>
  
  const copyableEls = document.querySelectorAll('.copyable');

  copyableEls.forEach((el) => {
    el.addEventListener('click', () => {
    
      const range = document.createRange();
      range.selectNodeContents(el);

      const selection = window.getSelection();
      selection.removeAllRanges();
      selection.addRange(range);

      document.execCommand('copy');

      selection.removeAllRanges();

      alert('Mot de passe copié dans le presse-papiers');
    });
  });
        
</script>
  </body>
</html>


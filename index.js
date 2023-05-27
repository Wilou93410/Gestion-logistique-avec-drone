const express = require('express');
const cookieParser = require('cookie-parser');

const app = express();
app.use(cookieParser());

app.get('/user', (req, res) => {
  // Récupérer la valeur du cookie "permission"
  const permission = req.cookies.permission;

  // Récupérer la valeur du cookie "pseudo"
  const id_user = req.cookies.id_user;

  console.log('id_user:', id_user); // Afficher la valeur du cookie "pseudo" dans le terminal

  if (permission === 'admin') {
    // Rediriger l'utilisateur vers admin.php
    res.redirect('http://localhost/logistic_drone/admin/admin.php');
  } else if (permission === 'user') {
    // Rediriger l'utilisateur vers user.php
    res.redirect('http://localhost/logistic_drone/user/user.php');
  } else {
    // Gérer le cas où la permission n'est pas définie ou a une valeur inattendue
    res.send('Erreur : permission invalide');
  }
});

app.listen(3003, () => {
  console.log('Serveur démarré sur le port 3003');
});

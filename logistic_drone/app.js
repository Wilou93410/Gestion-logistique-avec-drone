const db = require('./db')
const flyToPosition = require('./scripts/vol');
const express = require('express');
const app = express();
const cookieParser = require('cookie-parser');
app.use(cookieParser());

// Configuration du moteur de template EJS
app.set('view engine', 'ejs');

// Configuration du dossier public pour servir les fichiers statiques
app.use(express.static(__dirname + '/public'));

// Configuration des routes
app.get('/', (req, res) => {
  db.query('SELECT * FROM location', (err, results) => {
    if (err) {
      throw err;
    }
    res.render('index', { zones: results });
  });
});

app.use(express.urlencoded({ extended: true }));
app.use(express.json());

app.post('/vol', (req, res) => {
  const selectedZones = req.body;
  // Récupérer l'ID de l'utilisateur à partir du cookie "id_user"
  const userId = req.cookies.id_user;

  for (const zoneId of Object.values(selectedZones)) {
    flyToPosition(zoneId, userId); // Passer l'ID de l'utilisateur en tant que deuxième argument
  }

  res.render('vol'); // Rendre la page vol.ejs avec le contexte
});

//flo
app.get('/user', (req, res) => {
  // Récupérer la valeur du cookie "permission"
  const permission = req.cookies.permission;

  // Récupérer la valeur du cookie "pseudo"
  const userId = req.cookies.id_user;

  console.log('id_user:', userId); // Afficher la valeur du cookie "pseudo" dans le terminal
  console.log('permission :', permission);
  if (permission === 'admin') {
    // Rediriger l'utilisateur vers admin.php
    res.redirect('http://localhost/admin/admin.php');
  } else if (permission === 'user') {
    // Rediriger l'utilisateur vers user.php
    res.redirect('http://localhost/user/user.php');
  } else {
    // Gérer le cas où la permission n'est pas définie ou a une valeur inattendue
    res.send('Erreur : permission invalide');
  }
});
// Exporter la variable userId

// Démarrage du serveur
app.listen(3003, () => {
  console.log(`Server running on port 3003`);
});

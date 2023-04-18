const express = require('express');
const app = express();
const path = require('path');
const routes = require('./routes');
const runScript = require('./routes/runscript');
const bodyParser = require('body-parser');

// Définir le dossier statique
app.use('/scripts', express.static(path.join(__dirname, 'scripts')));



// Définir les routes pour les zones
app.use('/', routes);

app.use(express.static(path.join(__dirname, 'public')));

// Ajouter le middleware body-parser pour traiter le corps de la requête POST
app.use(bodyParser.urlencoded({ extended: false }));

app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'index.html'));
});

// Route pour la requête POST sur /runscript
app.post('/runscript', (req, res) => {
  const scriptName = req.body.script;
  runScript(scriptName);
  res.send(`Script "${scriptName}" lancé.`);
});



app.listen(3000, () => {
  console.log('Server listening on port 3000');
});

const express = require('express');
const app = express();
const path = require('path');
const routes = require('./routes');
const runScript = require('./public/runscript');
const bodyParser = require('body-parser');
const RedisStore =require('connect-redis')(session);
const session = require('express-session');


app.use(session({
  store: new RedisStore({
    // configure the Redis client options as needed
    host: '127.0.0.1',
    port: 6379
  }),
  secret: 'your-secret-key',
  resave: false,
  saveUninitialized: true
}));
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

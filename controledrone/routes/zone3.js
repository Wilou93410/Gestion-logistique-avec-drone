const express = require('express');
const router = express.Router();
const zone3Script = require('../scripts/zone3script');

router.post('/', (req, res) => {
  zone3Script.run();
  res.send('Zone 3 script started');
});

router.get('/script', (req, res) => {
  res.sendFile(path.join(__dirname, '..', 'scripts', 'zone3script.js'));
});

module.exports = router;

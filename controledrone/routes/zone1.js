const express = require('express');
const router = express.Router();
const zone1Script = require('../scripts/zone1script');

router.post('/', (req, res) => {
  zone1Script.run();
  res.send('Zone 1 script started');
});

router.get('/script', (req, res) => {
  res.sendFile(path.join(__dirname, '..', 'scripts', 'zone1script.js'));
});

module.exports = router;

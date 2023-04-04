
const express = require('express');
const router = express.Router();
const path = require('path');

const zone2Script = require('../scripts/zone2script');

router.post('/', (req, res) => {
  zone2Script.run();
  res.send('Zone 2 script started');
});

router.get('/script', (req, res) => {
  res.sendFile(path.join(__dirname, 'scripts', 'zone2script.js'));
});

module.exports = router;

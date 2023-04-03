const express = require('express');
const router = express.Router();
const zone1 = require('./zone1');
const zone2 = require('./zone2');
const zone3 = require('./zone3');


router.use('/zone1', zone1);
router.use('/zone2', zone2);
router.use('/zone3', zone3);

module.exports = router;

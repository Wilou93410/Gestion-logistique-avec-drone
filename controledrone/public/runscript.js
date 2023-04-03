const path = require('path');
const zone1Script = require(path.join(__dirname, '..', 'scripts', 'zone1script'));
const zone2Script = require(path.join(__dirname, '..', 'scripts', 'zone2script'));
const zone3Script = require(path.join(__dirname, '..', 'scripts', 'zone3script'));


function runScript(scriptName) {
  switch (scriptName) {
    case 'zone1':
      console.log('Starting Zone 1 script...');
      zone1Script.run();
      break;
    case 'zone2':
      console.log('Starting Zone 2 script...');
      zone2Script.run();
      break;
    case 'zone3':
      console.log('Starting Zone 3 script...');
      zone3Script.run();
      break;
    default:
      console.log(`Script "${scriptName}" not found.`);
  }
}

module.exports = runScript;

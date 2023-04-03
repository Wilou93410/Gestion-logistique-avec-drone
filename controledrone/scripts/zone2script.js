const Tello = require('../../src/tello');

module.exports = {
  run: function() {
    const tello = new Tello();
    tello.connect()
      .then(() => {
        console.log('Connecté au drone Tello.');
        return tello.sendCmd('command');
      })
      .then(() => {
        console.log('Le drone est prêt à décoller.');
        return tello.sendCmd('takeoff');
      })
      .then(() => {
        console.log('Le drone a décollé.');
        return tello.sendCmd('up 50');
      })
      .then(() => {
        console.log('Le drone est monté de 50cm.');
        return tello.sendCmd('forward 50');
      })
      .then(() => {
        console.log('Le drone est allé en avant de 50cm.');
        return tello.sendCmd('cw 180');
      })
      .then(() => {
        console.log('Le drone a tourné de 180 degrés.');
        return tello.sendCmd('land');
      })
      .then(() => {
        console.log('Le drone a atterri.');
        return tello.end();
      })
      .then(() => {
        console.log('La connexion au drone Tello a été fermée.');
      })
      .catch(error => {
        console.error(error);
      });
  }
};
